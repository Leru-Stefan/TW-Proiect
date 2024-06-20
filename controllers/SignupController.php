<?php
require_once 'BaseController.php';
require_once 'models/UserModel.php';

class SignupController extends BaseController {
    public function indexAction() {
        $this->render('signup');
    }

    public function registerAction() {
        $nume = $_POST['nume'];
        $prenume = $_POST['prenume'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            $_SESSION['signup_errors'] = ['Parolele nu coincid.'];
            header("Location: index.php?page=signup");
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $userModel = new UserModel();
        $userModel->nume = $nume;
        $userModel->prenume = $prenume;
        $userModel->email = $email;
        $userModel->password = $hashed_password;

        try {
            if ($userModel->save()) {
                header("Location: index.php?page=login");
            } else {
                $_SESSION['signup_errors'] = ['A apărut o eroare la crearea contului.'];
                header("Location: index.php?page=signup");
            }
        } catch (Exception $e) {
            $_SESSION['signup_errors'] = [$e->getMessage()];
            header("Location: index.php?page=signup");
        }
        exit;
    }
}
?>

