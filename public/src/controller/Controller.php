<?php
require_once __DIR__ . '/../model/CategoryModel.php';
class Controller
{
    protected function render(string $page, array $data = []): string
    {
        $path = __DIR__ . '/../../views/' . $page . '.php';
        if(!file_exists($path)) {
            throw new Exception("file not found");
        }
        extract($data);   // ['products' => [...]] ->  $products
        ob_start();      // start collecting output instead of printing it

        include $path;    // hand the collected HTML back as a string

        return ob_get_clean();
    }
    protected function view(string $name, array $data = []): void
    {
        if(!isset($data['categories'])) {
            $data['categories'] = (new CategoryModel())->getCategories();
        }

        extract($data);

        include __DIR__ . '/../../views/templates/header.php';
        include __DIR__ . '/../../views/' . $name . '.php';
        include __DIR__ . '/../../views/templates/footer.php';
    }
}
?>