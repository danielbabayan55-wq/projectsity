<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/ColorModel.php';

class ColorController extends Controller
{
    public function index(){
        $colorModel = new ColorModel();

        $data['all_color'] = $colorModel->getColor(1);

        $this->view('color', $data);
    }
}