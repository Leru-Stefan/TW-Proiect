<?php
require_once 'BaseController.php';
require_once 'models/ProblemModel.php';

class DownloadController extends BaseController {
    public function indexAction() {
        if (!isset($_GET['format']) || !isset($_GET['id'])) {
            die("Parametrii lipsesc.");
        }

        $format = $_GET['format'];
        $question_id = $_GET['id'];

        $model = new ProblemModel();
        $problem = $model->getProblemById($question_id);

        if (!$problem) {
            die("Problema nu a fost găsită.");
        }

        // Extragem doar titlul și conținutul problemei
        $filteredProblem = [
            'question_title' => $problem['question_title'],
            'description' => $problem['description']
        ];

        if ($format == 'json') {
            header('Content-Disposition: attachment; filename="Problema_' . $question_id . '.json"');
            header('Content-Type: application/json');
            echo json_encode($filteredProblem);
        } elseif ($format == 'xml') {
            header('Content-Disposition: attachment; filename="Problema_' . $question_id . '.xml"');
            header('Content-Type: application/xml');
            $xml = new SimpleXMLElement('<problem/>');
            foreach ($filteredProblem as $key => $value) {
                $xml->addChild($key, htmlspecialchars($value));
            }
            ob_clean();
            echo $xml->asXML();
        } else {
            die("Formatul nu este suportat.");
        }
    }
}
?>


