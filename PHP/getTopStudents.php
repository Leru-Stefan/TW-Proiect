<?php
require_once '../models/UserModel.php'; 
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

$userModel = new UserModel();
$topStudents = $userModel->getTopStudents();
echo json_encode($topStudents);
?>

