<?php
require_once '../models/UserModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    error_log("Received user_id: $userId");
    $userModel = new UserModel();
    try {
        error_log("Calling deleteUserKeepProblems method");
        $userModel->deleteUserKeepProblems($userId);
        error_log("deleteUserKeepProblems method executed successfully");
        echo 'Contul utilizatorului a fost șters cu succes!';
        exit;
    } catch (Exception $e) {
        error_log("Error deleting user account: ". $e->getMessage());
        echo 'Eroare la ștergerea contului.';
        exit;
    }
} else {
    echo 'user_id nu a fost furnizat.';
    exit;
}
?>
