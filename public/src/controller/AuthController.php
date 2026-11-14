<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/UserModel.php';

class AuthController extends Controller
{
    private UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function registerForm(): void
    {
        $this->view('register', ['errors' => [], 'old' => []]);
    }

    public function register(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['password_confirmation'] ?? '';

        $errors = [];

        if ($name === '') {
            $errors['name'] = 'Անունը պարտադիր է։';
        } elseif (mb_strlen($name) > 100) {
            $errors['name'] = 'Անունը շատ երկար է։';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Էլ. հասցեն սխալ է։';
        } elseif (strlen($email) > 190) {
            $errors['email'] = 'Էլ. հասցեն շատ երկար է։';
        } elseif ($this->users->findByEmail($email)) {
            $errors['email'] = 'Այս էլ. հասցեով հաշիվ արդեն կա։';
        }

        if (strlen($password) < 8) {
            $errors['password'] = 'Գաղտնաբառը պետք է լինի առնվազն 8 նիշ։';
        }

        if ($password !== $confirm) {
            $errors['password_confirmation'] = 'Գաղտնաբառերը չեն համընկնում։';
        }

        if ($errors) {
            $this->view('register', [
                'errors' => $errors,
                'old' => ['name' => $name, 'email' => $email],
            ]);
            return;
        }

        $this->users->create($name, $email, password_hash($password, PASSWORD_DEFAULT));

        header('Location: /login');
        exit;
    }


    public function loginForm(): void
    {
        $this->view('login', ['error' => null, 'email' => '']);
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->users->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->view('login', [
                'error' => 'Էլ. հասցեն կամ գաղտնաբառը սխալ է։',
                'email' => $email,
            ]);
            return;
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        header('Location: /account');
        exit;
    }


    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        header('Location: /');
        exit;
    }

    public function index(): void
    {
        $this->view('account', [
            'title' => 'Անձնական էջ'
        ]);
    }
}