<?php
require_once 'BaseController.php';
require_once 'models/UserModel.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class SetariController extends BaseController {
    public function indexAction() {
        $this->checkAuthentication();
        $this->render('setari');
    }

    public function changePasswordAction() {
        $this->checkAuthentication();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['curr_password'] ?? null;
            $newPassword = $_POST['new_password'] ?? null;
            $userId = $_SESSION['user_id'];

            error_log("Parola curenta: " . $currentPassword);
            error_log("Parola noua: " . $newPassword);
            error_log("User ID: " . $userId);

            if ($currentPassword && $newPassword) {
                $userModel = new UserModel();

                try {
                    $userModel->changePassword($userId, $currentPassword, $newPassword);
                    echo 'Parola a fost schimbată cu succes.';
                } catch (Exception $e) {
                    error_log("Eroare la schimbarea parolei: " . $e->getMessage());
                    echo 'Eroare: ' . $e->getMessage();
                }
            } else {
                error_log("Toate câmpurile sunt obligatorii.");
                echo 'Toate câmpurile sunt obligatorii.';
            }
        } else {
            error_log("Cerere invalidă.");
            echo 'Cerere invalidă.';
        }
    }
}
?>
