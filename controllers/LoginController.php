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
        $userDetails = $userModel->authenticate($email, $password);
        
        if ($userDetails) {
            $_SESSION['user'] = $email; // Sau un ID de utilizator pentru a fi mai sigur
            $_SESSION['prenume'] = $userDetails['prenume'];
            $_SESSION['user_id'] = $userDetails['user_id'];
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

