<?php
// Configurare
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'sql_two';

// Conectare la baza de date
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Verificare conexiune
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

// Preluare ID întrebare din query string
$question_id = isset($_GET['id']) ? $_GET['id'] : 0;

$response = array();

// Verificare dacă ID întrebare este valid
if ($question_id > 0) {
    // Pregătire și executare interogare SQL pentru a prelua detaliile întrebării
    $stmt = $conn->prepare("SELECT question_title, description FROM questions WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $stmt->bind_result($title, $description);

    // Dacă întrebarea există în baza de date, preluăm datele
    if ($stmt->fetch()) {
        $response = array(
            'question_title' => $title,
            'description' => $description
        );
    } else {
        $response = array('error' => 'Întrebarea nu a fost găsită.');
    }

    $stmt->close();
} else {
    $response = array('error' => 'ID întrebare invalid.');
}

// Returnare răspuns sub formă de JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

