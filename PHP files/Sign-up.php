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
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

//verificare daca email-ul este in baza de date
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Acest email este deja folosit.";
    exit();
}

if ($password != $confirm_password) {
    echo "Parolele nu se potrivesc.";
    exit();
}

// Hash-uirea parolei
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Pregătirea și executarea interogării SQL
$stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $fullname, $email, $hashed_password);

if ($stmt->execute()) {
    echo "Înregistrare reușită!";
} else {
    echo "Eroare la înregistrare. Te rugăm să încerci din nou.";
    error_log("Error in signup.php: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>


