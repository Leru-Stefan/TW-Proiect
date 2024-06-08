<?php
class ImportController {
    public function importFromJson($jsonFilePath) {
        $userId = $_SESSION['user_id']; // Assuming the user is logged in and user_id is in session
        $addedBy = 'user'; // Or 'admin', depending on the role of the logged-in user

        $json = file_get_contents($jsonFilePath);
        $problems = json_decode($json, true);

        $questionModel = new QuestionModel();

        foreach ($problems as $problem) {
            $questionModel->title = $problem['title'];
            $questionModel->content = $problem['content'];
            $questionModel->correct_answer = $problem['correct_answer'];
            $questionModel->save($userId, $addedBy);
        }

        return true; // or some meaningful result
    }
}
?>