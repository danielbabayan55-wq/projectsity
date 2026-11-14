<?php
require_once __DIR__ . '/../core/Database.php';

class ColorModel extends ProductModel
{
    private \PDO $db;
    
    public function __construct(){
        $this->db = $this->connect();
    }

    public function getColor($productId):array{
        $stmt = $this->db->prepare("SELECT * FROM product_variants WHERE product_id = ?");
    $stmt->execute([$productId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);;
    }
}