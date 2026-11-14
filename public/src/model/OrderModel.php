<?php

class OrderModel
{
    public const array STATUS = [
        'new'       =>   'Նոր',
        'paid'      =>   'Վճարված',
        'shipped'   => 'Ուղարկված',
        'cancelled' => 'Չեղարկված',
    ];

    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // account.php: orders of one user
    public function getByUser(int $userId): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC'
        );
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    // admin/orders.php: all orders, newest first
    public function getAll(): array
    {
        return $this->db->query(
            'SELECT * FROM orders ORDER BY created_at DESC'
        )->fetchAll();
    }

    // products inside one order
    public function getItems(int $orderId): array
    {
        $stmt = $this->db->prepare(
            'SELECT oi.quantity oi.price p.name
            FROM orders_items oi
            JOIN products p ON p.id = oi.product_id
            WHERE oi.orders_id = ?'
        );
         $stmt->execute([$orderId]);

         return $stmt->fetchAll();
    }
}