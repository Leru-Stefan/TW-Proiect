<?php
require_once 'BaseController.php';

class LoginController extends BaseController {
    public function indexAction() {
        $this->render('login');
    }

    public function authenticateAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = [];

            $user = new UserModel();
            $userData = $user->findByEmail($email);

            if ($userData && password_verify($password, $userData['password'])) {
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['user_name'] = $userData['fullname'];
                header('Location: index.php?page=probleme');
                exit();
            } else {
                $errors[] = "Email-ul sau parola sunt incorecte.";
                $_SESSION['login_errors'] = $errors;
                header('Location: index.php?page=login');
                exit();
            }
        } else {
            echo "Cerere invalidă.";
        }
    }

    public function logoutAction() {
        session_destroy();
        header('Location: index.php?page=login');
        exit();
    }
}
?>