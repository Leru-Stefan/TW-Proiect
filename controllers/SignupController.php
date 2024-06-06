<?php
require_once 'BaseController.php';
require_once 'models/UserModel.php';

class SignupController extends BaseController {
    public function indexAction() {
        $this->render('signup');
    }

    public function registerAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $errors = [];

            if ($password !== $confirm_password) {
                $errors[] = "Parolele nu se potrivesc.";
            }

            $user = new UserModel();
            if ($user->emailExists($email)) {
                $errors[] = "Email-ul este deja utilizat.";
            }

            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                
                $user->fullname = $fullname;
                $user->email = $email;
                $user->password = $hashed_password;

                if ($user->save()) {
                    header('Location: index.php?page=probleme');
                    exit();
                } else {
                    $errors[] = "A apărut o eroare la înregistrare.";
                }
            }

            // Stocăm mesajele de eroare în sesiune
            $_SESSION['errors'] = $errors;
            header('Location: index.php?page=signup');
            exit();
        } else {
            echo "Cerere invalidă.";
        }
    }
}
?>
