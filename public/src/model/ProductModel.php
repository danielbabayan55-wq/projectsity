<?php
require_once __DIR__ . '/CategoryModel.php';
    class ProductModel extends Database
    {
          private \PDO $db;
          private CategoryModel $category;

    public function __construct() {
        $this->db = Database::connect();
        $this->category = new CategoryModel;
    }

    public function getProducts(array $filter):array{
        extract($filter);

        $filtering = '';
        $join = '';
        $select = '';

        $params = [
            'limit'  => (int) $limit,
            'offset' => (int) $offset,
        ];
// Category filter
        if(!empty($category)) {
            $join = "LEFT JOIN categories c ON p.category_id = c.id";
            $select = ",
                c.name AS category_name,
                c.slug AS category_slug
            ";

            $filtering = " AND c.id = :category";
            $params['category'] = $category;
        }
        // Stock filter
        if($stock === 'in') {
            $filtering .= " AND p.stock > 0";

        }elseif($stock === 'sale'){
            $filtering .= " AND p.discount > 0";
        }
        // Search
        if($q !== '') {
            $filtering = "AND (
            p.description LIKE :description
            ON p.name LIKE :name
            ) ";

            $params['description'] = '%' . $q . '%';
            $params['name'] = '%' . $q . '%';
        }

        // Discounted price calculation
        $finalPrice = "(p.price - p.price * p.discount / 100)";

        // Minimum price
        if ($min !== null && $min !== '') {
            $filtering .= "AND $finalPrice >= :min";
            $params['min'] = $min;
        }
        // Maximum price
        if($max !== null && $max !== '') {
            $filtering .= "AND $finalPrice <= :max";
            $params['max'] = $max;
        }
        // Allowed sorting
        $allowedSorts = [
            'p.created_at DESC',
            'final_price ASC',
            'final_price DESC',
            'p.name ASC'
        ];
        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'p.created_at DESC';
        }
        $sql = "SELECT
                p.*,
                $finalPrice AS final_price,
                p.id AS product_id,
                p.name AS product_name,
                p.slug AS product_slug
                $select
            FROM products p
            $join
            WHERE 1=1
            $filtering
            ORDER BY $sort
            LIMIT :offset, :limit";
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $type = in_array($key, ['limit', 'offset'], true)
                ? PDO::PARAM_INT
                : PDO::PARAM_STR;

            $stmt->bindValue(":$key", $value, $type);
        }
         $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     
    public function getLatestProducts(): array {
        $sql = "SELECT * FROM products LIMIT 6";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByid(int $id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
    
    }  