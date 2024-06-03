<?php
$servername = "localhost";
$username = "root"; // Username-ul standard pentru XAMPP
$password = ""; // Parola standard pentru XAMPP
$dbname = "sql_two";

// Crearea conexiunii
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificarea conexiunii
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preluarea datelor din formular
$email = $_POST['username'];
$password = $_POST['password'];

// Verificarea dacă utilizatorul există și parola este corectă
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo "Login reușit!";
        // Aici poți adăuga logica pentru a iniția sesiunea utilizatorului
    } else {
        echo "Parola incorectă.";
    }
} else {
    echo "Email incorect.";
}

$stmt->close();
$conn->close();
?>
