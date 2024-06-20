<?php
require_once '../models/UserModel.php'; 

$userModel = new UserModel();
$topStudents = $userModel->getTopStudents();

header('Content-Type: application/json');
echo json_encode($topStudents);
?>

