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
            $currentPassword = $_POST['curr-password'] ?? null;
            $newPassword = $_POST['new-password'] ?? null;
            $userId = $_SESSION['user_id'];
    
            error_log("Parola curenta: " . $currentPassword);
            error_log("Parola noua: " . $newPassword);
            error_log("User ID: " . $userId);
    
            if ($currentPassword && $newPassword) {
                $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
                if (!preg_match($password_pattern, $newPassword)) {
                    error_log("Parola nouă nu îndeplinește cerințele de complexitate.");
                    echo json_encode(array('success' => false, 'error' => 'Parola nouă trebuie să aibă cel puțin 8 caractere, să conțină litere mari, litere mici și cifre.'));
                    return;
                }
    
                $userModel = new UserModel();
    
                try {
                    $userModel->changePassword($userId, $currentPassword, $newPassword);
                    echo json_encode(array('success' => true, 'message' => 'Parola a fost schimbată cu succes.'));
                    return;
                } catch (Exception $e) {
                    error_log("Eroare la schimbarea parolei: " . $e->getMessage());
                    echo json_encode(array('success' => false, 'error' => 'Eroare: ' . $e->getMessage()));
                    return;
                }
            } else {
                error_log("Toate câmpurile sunt obligatorii.");
                echo json_encode(array('success' => false, 'error' => 'Toate câmpurile sunt obligatorii.'));
                return;
            }
        } else {
            error_log("Cerere invalidă.");
            echo json_encode(array('success' => false, 'error' => 'Cerere invalidă.'));
            return;
        }
    }
    
}
?>
