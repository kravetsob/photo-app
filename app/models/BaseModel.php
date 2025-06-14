<?php

namespace app\models;

use app\core\Database;

class BaseModel {
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}