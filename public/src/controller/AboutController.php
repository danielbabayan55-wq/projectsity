<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/AboutModel.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Csrf.php';


class AboutController extends Controller
{
    private AboutModel $aboutModel;
    public function __construct()
    {
        $this->aboutModel = new AboutModel();
    }

    public function index(): void
    {
        if (Auth::hasRole('admin')) {
            $feedback = $this->aboutModel->getAllFeedbackForAdmin() ?? [];
        }else {
            $feedback = $this->aboutModel->getApprovedFeedback() ?? [];
        }
        $items = $this->aboutModel->getAllAbout() ?? [];

        $this->view('about', [
            'title'    => 'Մեր մասին',
            'items'    => $items,
            'feedback' => $feedback,
        ]);

    }

    public function feedback(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if (!empty($name) && !empty($message)) {
                $this->aboutModel->addFeedback($name, $message);
            }
        }

        header('Location: /about?feedback=1');
        exit;
    }

    public function delete(): void
    {
        if (!Auth::hasRole('admin')) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Csrf::check();
        }
        $id = (int) ($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->aboutModel->deleteFeedback($id);
        }

        header('Location: /about?deleted=1');
        exit;
    }

    public function approve(): void
    {
        if (!Auth::hasRole('admin')) {
            header('Location: /login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Csrf::check();
        }
        $id = (int) ($_GET['id'] ?? 0);

        if ($id > 0) {
            $this->aboutModel->approveFeedback($id);
        }

        header('Location: /about?approved=1');
      exit;
    }
}