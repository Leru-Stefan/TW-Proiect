<?php
require '../models/ProblemModel.php';
error_reporting(0);
@ini_set('display_errors', 0);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $problemId = $_POST['problem_id'];

    $problemModel = new ProblemModel();
    if (!empty($problemId)) {
        try {
            $problemModel->deleteProblem($problemId);
            $response = ['success' => true];
        } catch (Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
    } else {
        $response = ['success' => false, 'message' => 'Invalid problem ID'];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    $response = ['success' => false, 'message' => 'Invalid request method'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>