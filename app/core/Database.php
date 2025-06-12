<?php

namespace app\core;

use mysqli;

class Database
{
    protected static $instance = null;
    protected $connector;

    public static function getInstance(): Database
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->connector = new mysqli(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );
    }

    private function __clone(): void
    {
    }

    public function __wakeup(): never
    {
        exit('Singleton');
    }

    /**
     * Метод повертає список асоціативних масивів при вибираючих запитах, або bool при невибираючих запитах
     * @param mixed $query
     * @return array<array|bool|null>|bool
     */
    public function query($query): array|bool
    {
        $result = $this->connector->query($query);
        if (is_bool($result)) {
            return $result;
        }
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}