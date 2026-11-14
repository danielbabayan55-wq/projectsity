<?php
require_once __DIR__ . '/ProductModel.php';

class NewsModel extends ProductModel
{
    private \PDO $db;

    public function __construct(){
        $this->db = $this->connect();
    }

    public function getAllNews(): array{
        return $this->db->query("SELECT * FROM news")->fetchAll(PDO::FETCH_ASSOC);
    }
}