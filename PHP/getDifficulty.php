<?php
require_once '../models/ProblemModel.php'; 
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

$problemModel = new ProblemModel();
$difficulty = $problemModel->updateOrInsertDifficulty();
echo json_encode($difficulty);
?>