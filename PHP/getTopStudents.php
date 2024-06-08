<?php
// getTopStudents.php
require_once '../models/UserModel.php'; // Includem UserModel

// Creăm o instanță a clasei UserModel
$userModel = new UserModel();

// Apelăm funcția getTopStudents pentru a obține topul studenților
$topStudents = $userModel->getTopStudents();

// Returnăm rezultatul sub formă de JSON
header('Content-Type: application/json');
echo json_encode($topStudents);
?>

