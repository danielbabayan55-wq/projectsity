<?php
require_once __DIR__ . '/../model/ProductModel.php';
class CartController extends Controller
{
    public function initSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function index(): void
    {
        $this->initSession();
        $productModel = new ProductModel();
        $items = [];
        $totalCount = 0;
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $productId => $qty) {
           $product = $productModel->getByid((int)$productId);
            if ($product) {
                $price = !empty($product['discount'])
                    ? ($product['price'] - $product['price'] * $product['discount'] / 100)
                    : $product['price'];
                $subtotal = $price * $qty;
                $items[] = [
                    'product'  => $product,
                    'qty'      => $qty,
                    'price'    => $price,
                    'subtotal' => $subtotal
                ];
                $totalCount += $qty;
                $totalPrice += $subtotal;
            }
        }

        $this->view('cart', [
            'title' => 'Զամբյուղ',
            'items' => $items,
            'totalPrice' => $totalPrice,
            'totalCount' => $totalCount,
        ]);

    }

    public function add(): void
    {
        $this->initSession();
        $productId = (int) ($_POST['id'] ?? 0);
        $backUrl = $_POST['back'] ?? '/catalog';

        if ($productId > 0) {
            $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + 1;
        }
        header('Location: ' . $backUrl);
        exit;
    }

    public function update(): void
    {
        $this->initSession();
        $productId = (int) ($_POST['id'] ?? 0);
        $action = $_POST['action'] ?? '';

        if ($productId > 0 && isset($_SESSION['cart'][$productId])) {
            if ($action === 'inc') {
                $_SESSION['cart'][$productId]++;
            } elseif ($action === 'dec') {
                $_SESSION['cart'][$productId]--;
                if ($_SESSION['cart'][$productId] <= 0) {
                    unset($_SESSION['cart'][$productId]);
                }
            }
        }

        header('Location: /cart');
        exit;
    }

    public function remove(): void
    {
        $this->initSession();
        $productId = (int) ($_POST['id'] ?? 0);
        unset($_SESSION['cart'][$productId]);

        header('Location: /cart');
        exit;
    }

    public function clear(): void
    {
        $this->initSession();
        $_SERVER['cart'] = [];

        header('Location /cart');
        exit;

    }
}