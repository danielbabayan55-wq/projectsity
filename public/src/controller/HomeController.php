<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/ProductModel.php';

class HomeController extends Controller
{
    private ProductModel $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    public function index(): void
    {
        $this->view('home', ['products' => $this->model->getLatestProducts()] );
    }
}