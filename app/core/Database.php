<?php

namespace app\core;

use mysqli;

/**
 * Database MYSQLI Singleton
 */
class Database
{
    /**
     * @var null
     */
    protected static $instance = null;

    /**
     * @var mysqli
     */
    protected mysqli $connector;

    /**
     * Returns a reference to the Database object
     * @return Database
     */
    public static function getInstance(): Database
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Database constructor
     */
    private function __construct()
    {
        $this->connector = new mysqli(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );
    }

    /**
     * Prevents cloning of the singleton instance
     * @return void
     */
    private function __clone(): void
    {
    }

    /**
     * Prevents unserializing of the singleton instance
     * @return never
     */
    public function __wakeup(): never
    {
        exit('Singleton');
    }

    /**
     * Метод повертає список асоціативних масивів при вибираючих запитах, або bool при невибираючих
     * types i-int, d-float, s-string
     * @param string $query
     * @param string $types
     * @param array $params
     * @return array|bool
     */
    public function query(string $query, string $types = '', array $params = []): array|bool
    {
        $stmt = $this->connector->prepare($query);
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        $status = $stmt->execute();
        if (!$status) {
            exit('Query error ' . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result instanceof \mysqli_result) {
            if ($result->num_rows === 0) {
                return [];
            } else {
                $data = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                return $data;
            }
        }

        $stmt->close();
        return true;
    }
}