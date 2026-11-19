<?php

require_once __DIR__ . '/../model/WishlistModel.php';

class WishlistController extends Controller
{
    private WishlistModel $wishlistModel;
    public function __construct()
    {
        $this->wishlistModel = new WishlistModel();
    }
    public function index(): void
    {
        $ids = $_SESSION['wishlist'] ?? [];
        $products = $this->wishlistModel->getProductsByIds($ids);
        $this->view('wishlist', [
            'title' => 'Ցանկ',
            'products' => $products,
        ]);
    }

    public function toggle(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Csrf::check();

            $productId = (int) ($_POST['product_id'] ?? 0);
            if ($productId > 0) {
                if (!isset($_SESSION['wishlist'])) {
                    $_SESSION['wishlist'] = [];
                }
                if (in_array($productId, $_SESSION['wishlist'])) {
                    $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$productId]);
                } else {
                    $_SESSION['wishlist'][] = $productId;
                }
            }
        }

        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/wishlist'));
        exit;
    }

    public function clear(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Csrf::check();

            $_SESSION['wishlist'] = [];
        }

        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/wishlist'));
        exit;
    }
}