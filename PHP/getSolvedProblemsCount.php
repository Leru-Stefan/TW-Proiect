<?php
require_once '../models/UserModel.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $userModel = new UserModel();
    try {
        $result = $userModel->getSolvedProblemsCountAndRole($userId);
        header('Content-Type: application/json');
        echo json_encode($result);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'User not logged in']);
}
?>
