<?php
class CategoryModel
{
    private PDO $db;
    public function __construct()
    {
        $this->db = Database::connect();
    }

      public function getCategoryBySlug(string $slug){
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE slug = :slug");
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch();
    }  
        
    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}