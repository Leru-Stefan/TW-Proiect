<?php
require_once 'BaseController.php';
require_once 'models/UserModel.php';

class LoginController extends BaseController {
    public function indexAction() {
        $this->render('login');
    }

    public function authenticateAction() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $userModel = new UserModel();
        // Debugging: Verificare email și parola hash-uită
        var_dump($email, $password);
        
        if ($userModel->authenticate($email, $password)) {
            $_SESSION['user'] = $email; // Sau un ID de utilizator pentru a fi mai sigur
            var_dump($_SESSION); // Debugging: Verificare sesiune
            header("Location: index.php?page=probleme");
            exit;
        } else {
            $_SESSION['login_errors'] = ['Email sau parolă incorecte.'];
            header("Location: index.php?page=login");
            exit;
        }
    }
}
?>

