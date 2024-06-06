<?php
// controllers/ProblemeController.php
require_once 'BaseController.php';
require_once 'models/UserModel.php';

class ProfileController extends BaseController {
    public function indexAction() {
        $userModel = new UserModel();
        $userRole = $userModel->getRole($_SESSION['user']);

        // Verificăm rolul utilizatorului și direcționăm către pagina de profil corespunzătoare
        if ($userRole === 'admin') {
            header("Location: index.php?page=admin");
            exit;
        }
        $this->render('profile');

    }
}
?>