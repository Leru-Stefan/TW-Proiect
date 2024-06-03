<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'sql_two';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve problems from database
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

$problems = array();

if ($result->num_rows > 0) {
    // Afișează fiecare problemă
    while($row = $result->fetch_assoc()) {
        $problems[] = array(
            'id' => $row['question_id'],
            'title' => $row['question_title'],
            'description' => $row['description']
        );
    }
}

// Close connection
$conn->close();

// Output problems in JSON format
header('Content-Type: application/json');               
echo json_encode($problems);
?>

