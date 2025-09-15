<?php
// app/Models/Customer.php
require_once __DIR__ . '/../Core/Database.php';

class Customer
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM customers ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE id = ?");
        $stmt->execute([(int)$id]);
        return $stmt->fetch();
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO customers (name, email, phone, address, company_name)
            VALUES (:name, :email, :phone, :address, :company_name)
        ");
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address'] ?? null,
            ':company_name' => $data['company_name'] ?? null
        ]);
    }

    public function update($id, array $data)
    {
        $stmt = $this->db->prepare("
            UPDATE customers SET name = :name, email = :email, phone = :phone, address = :address, company_name = :company_name, updated_at = NOW()
            WHERE id = :id
        ");
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address'] ?? null,
            ':company_name' => $data['company_name'] ?? null,
            ':id' => (int)$id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM customers WHERE id = ?");
        return $stmt->execute([(int)$id]);
    }

    // optional: search
    public function search($q)
    {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE name LIKE :q OR email LIKE :q ORDER BY id DESC");
        $stmt->execute([':q' => "%{$q}%"]);
        return $stmt->fetchAll();
    }
}
?>