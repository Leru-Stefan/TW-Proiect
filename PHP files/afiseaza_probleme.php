<?php
include 'db_connection.php';
?>

<?php
// Interogare pentru a prelua datele din tabela 'questions'
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

// Verificarea dacă s-au găsit rezultate
if ($result->num_rows > 0) {
    // Afișează fiecare problemă
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<h2>" . $row['question_title'] . "</h2>";
        echo "<p>" . $row['description'] . "</p>";
        echo "</div>";
    }
} else {
    echo "Nu s-au găsit întrebări în baza de date.";
}

// Închiderea conexiunii la baza de date
$conn->close();
?>

