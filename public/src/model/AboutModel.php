<?php

class AboutModel
{
    private PDO $db;
    public function __construct()
   {
    $this->db = Database::connect();
   }

   public function getAllAbout(): array
   {
    $stmt = $this->db->query("SELECT * FROM about WHERE is_active = 1 ORDER BY name ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function addFeedback(string $name, string $message):bool
   {
    $stmt = $this->db->prepare("INSERT INTO feedback (name, message) VALUES (?, ?)");
    return $stmt->execute([$name, $message]);
   }

   public function deleteFeedback(int $id): bool
   {
    $stmt = $this->db->prepare("DELETE FROM feedback WHERE id = ?");
    return $stmt->execute([$id]);
   }

   public function approveFeedback(int $id): bool
   {
    $stmt = $this->db->prepare("UPDATE feedback SET is_approved = 1 WHERE id = ?)");
    return $stmt->execute([$id]);
   }

   public function getApprovedFeedback(): array
   {
    $stmt = $this->db->query("SELECT * FROM feedback WHERE is_approved = 1 ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function getAllFeedbackForAdmin(): array
   {
    $stmt = $this->db->query("SELECT * FROM feedback ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

} 