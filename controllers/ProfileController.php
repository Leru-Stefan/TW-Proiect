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
        // $this->render('profile');

        // Obținem ID-ul utilizatorului autentificat
        $userModel = new UserModel();
        $userId = $userModel->getIdByEmail($_SESSION['user']);

        // Obținem numărul de probleme rezolvate de utilizator
        $solvedProblemsCount = $userModel->getSolvedProblemsCount($userId);

        // Obținem numărul de probleme adăugate de utilizator
        $addedProblemsCount = $userModel->getAddedProblemsCount($userId);

         // Obținem accuratetea utilizatorului
        $accuarcy = $userModel->getAccuracy($userId);

        // Obținem problemele rezolvate de utilizator
        $solvedProblems = $userModel->getSolvedProblems($userId);


        // Rendăm pagina de profil și transmitem datele pentru afișare
        $this->render('profile', ['solvedProblemsCount' => $solvedProblemsCount, 'addedProblemsCount' => $addedProblemsCount, 'accuracy' => $accuarcy, 'solvedProblems' => $solvedProblems, 'fullname' => $_SESSION['fullname']]);

    }

}
?>