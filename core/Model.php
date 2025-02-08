<?php

namespace Core;

use PDO;

class Model
{
    protected $db;

    /**
     * Поскольку проект маленький, конфигурацию бд задаю прямо в PDO, чтобы не создавать дополнительные файлы конфигурации
     */
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=intervolgatest', 'mysql', 'password');
    }

    /**
     * Геттер для миграции
     * @return PDO
     */
    public function getDb()
    {
        return $this->db;
    }
}

