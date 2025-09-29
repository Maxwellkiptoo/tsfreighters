<?php
// app/Models/Service.php

require_once __DIR__ . '/../Core/Database.php';

class Service
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM services ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Optional: add create, update, delete if needed
}
