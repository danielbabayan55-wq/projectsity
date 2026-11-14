<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/NewsModel.php';

class NewsController extends Controller
{
    public function index(){
        $newModel = new NewsModel();

        $data['all_news'] = $newModel->getAllNews();

        $this->view('news', $data);
    }
}