<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/ProductModel.php';
class ProductController extends Controller
{
    private ProductModel $model;
    public $PER_PAGE = 6;

    /** Սյունակի անունը չի պարամետրացվում → սպիտակ ցուցակ — PHP Դաս 10 */
    public $SORTS = [
        'newest'     => ['Նորերը',               'p.created_at DESC'],
        'price_asc'  => ['Գինը՝ աճման կարգով',   'final_price ASC'],
        'price_desc' => ['Գինը՝ նվազման կարգով', 'final_price DESC'],
        'name'       => ['Անունով',              'p.name ASC'],
    ];

    public $STOCK = [
        'all'  => 'Բոլորը',
        'in'   => 'Միայն առկաները',
        'sale' => 'Միայն զեղչվածները',
    ];
    public function __construct()
    {
        $this->model = new ProductModel();
    }


    public function index(): void
    {
        $sort = $_GET['sort'] ?? 'newest';

        if (!isset($this->SORTS[$sort])) {
            $sort = 'newest';
        }

        $page = max(1, (int)($_GET['page'] ?? 1));

        $filters = [
            'stock' => $_GET['stock'] ?? 'all',
            'q' => trim($_GET['q'] ?? ''),
            'min' => $_GET['min'] ?? null,
            'max' => $_GET['max'] ?? null,
            'category' => $_GET['category'] ?? null,
        ];

        if (!isset($this->STOCK[$filters['stock']])) {
            $filters['stock'] = 'all';
        }

        $params = [
            ...$filters,
            'limit' => $this->PER_PAGE,
            'offset' => ($page - 1) * $this->PER_PAGE,
            'sort' => $this->SORTS[$sort][1],
        ];

        $products = $this->model->getProducts($params);

        // Fetch one extra product to determine whether another page exists.
        // $params['limit'] = $this->PER_PAGE + 1;
        // $productsAll = $this->model->getProducts($params);

        // $hasNextPage = count($productsAll) > $this->PER_PAGE;

        // if ($hasNextPage) {
        //     array_pop($products);
        // }
        $this->view('catalog', [
            'products' => $products,
            'filters' => $filters,
            'sort' => $sort,
            'sorts' => $this->SORTS,
            'stockOptions' => $this->STOCK,
            'page' => $page,
            // 'hasNextPage' => $hasNextPage,
            'category' => null,
        ]);
    }

    public function show(int $id): void
    {
        $productModel = new ProductModel();
        $product = $productModel->getByid($id);
        if (empty($product)) {
            http_response_code(404); 
            echo '404 - Page not found'; 
            return;
        }
            
        $this->view('product', [
                'title' => $product['name'] ?? 'Ապրանք',
                'product' => $product
            ]);


    }
}
