<?php
// getDifficulty.php

require_once '../models/ProblemModel.php';

// Verificăm tipul de request
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SERVER['CONTENT_TYPE']) || $_SERVER['CONTENT_TYPE'] !== 'application/json') {
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
}

if (!isset($data['difficulty'])) {
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'Missing difficulty']);
    exit;
}

// Obținem id-ul întrebării din sesiune sau de unde ați salvat-o
session_start();
if (!isset($_SESSION['question_id'])) {
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'Missing question_id']);
    exit;
}
$question_id = $_SESSION['question_id'];

$difficulty = $data['difficulty'];

$model = new ProblemModel();
$success = $model->updateOrInsertDifficulty($question_id, $difficulty);

if ($success) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500); // Internal server error
    echo json_encode(['error' => 'Failed to update difficulty']);
}
?>

