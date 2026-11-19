<?php 
declare(strict_types= 1);

require_once __DIR__ . '/Controller.php';

class AdminController extends Controller
{
    public function index(): void
    {
        if(!Auth::hasRole('admin')){
            header('Location: /login');
            exit();
        }
        $this->view('admin-panel', [
            'title' => 'Ադմին պանել'
        ]);
    }
}