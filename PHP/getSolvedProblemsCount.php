<?php
require_once 'models/UserModel.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $userModel = new UserModel();
    $solvedCount = $userModel->getSolvedProblemsCount($userId);

    echo json_encode(['solvedCount' => $solvedCount]);
} else {
    echo json_encode(['error' => 'User not logged in']);
}
?>
