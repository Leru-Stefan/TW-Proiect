<?php
require_once 'BaseController.php';
require_once '../models/ProblemModel.php';

class ImportController {
    public function importProblems($jsonFilePath = null, $problemData = null) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['user_id']; // Assuming the user is logged in and user_id is in session
        $addedBy = 'user'; // Or 'admin', depending on the role of the logged-in user

        if ($jsonFilePath) {
            $json = file_get_contents($jsonFilePath);
            $problems = json_decode($json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON file.");
            }
        } elseif ($problemData) {
            $problems = [$problemData];
        } else {
            return false; // No data to import
        }

        $questionModel = new ProblemModel();

        foreach ($problems as $problem) {
            $questionModel->content = $problem['content'];
            $questionModel->correct_answer = $problem['correct_answer'];
            $questionModel->save($userId, $addedBy);
        }

        return true; // or some meaningful result
    }
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $importController = new ImportController();

    if (isset($_FILES['jsonFile']) && $_FILES['jsonFile']['error'] == UPLOAD_ERR_OK) {
        $jsonFilePath = $_FILES['jsonFile']['tmp_name'];
        try {
            $importController->importProblems($jsonFilePath);
            echo "Problems imported successfully from JSON.";
        } catch (Exception $e) {
            echo "Error importing problems: " . $e->getMessage();
        }
    } elseif (!empty($_POST['descriere']) && !empty($_POST['rezolvare'])) {
        $problemData = [
            'title' => 'Manual Input',
            'content' => $_POST['descriere'],
            'correct_answer' => $_POST['rezolvare']
        ];
        $importController->importProblems(null, $problemData);
        echo "Problem imported successfully from form.";
    } else {
        // Handle error: no data provided
        echo "Please provide a problem description and solution or upload a JSON file.";
    }
}
?>
