<?php
require 'Database.php'; // Include the database connection file

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $problemId = $_POST['problem_id'];

    $problemModel = new ProblemModel();
    if (!empty($problemId)) {
        try {
            $problemModel->deleteProblem($problemId);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid problem ID']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

?>