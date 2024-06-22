<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_errors', 0); // Disable error display
ini_set('display_startup_errors', 0); // Disable startup error display
error_reporting(0); // Disable error reporting

require_once '../models/User.php';
header('Content-Type: application/json');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = ['success' => false, 'message' => 'Unknown error occurred.'];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $userId = $_SESSION['user_id']; // Presupunem că user_id este stocat în sesiune
        $currentPassword = $data['currentPassword'];
        $newPassword = $data['newPassword'];

        $userModel = new UserModel();
        $userDetails = $userModel->changePassword($userId, $currentPassword, $newPassword);

        $response = ['success' => true, 'message' => 'Parola a fost schimbată cu succes.'];
        echo json_encode($response);
    }
} catch (Exception $e) {
    $response = ['success' => false, 'message' => $e->getMessage()];
    echo json_encode($response);
}
error_log("Error: " . $e->getMessage(), 3, "error.log");
?>
