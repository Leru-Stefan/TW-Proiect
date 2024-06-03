<?php
// index.php
$page = isset($_GET['page']) ? $_GET['page'] : 'landing';
$content_file = 'HTML files/' . $page . '.html';
$js_file = './JS files/' . $page . '.js';
$css_file = './CSS files/' . $page . '.css';

if (!file_exists($content_file)) {
    $content_file = 'HTML files/404.html';
    $js_file = '';
    $css_file = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Content Loading</title>
    <?php if ($css_file && file_exists($css_file)): ?>
    <link rel="stylesheet" href="<?php echo $css_file; ?>">
    <?php endif; ?>
</head>
<body>
    <?php include($content_file); ?>
    <?php if ($js_file && file_exists($js_file)): ?>
    <script src="<?php echo $js_file; ?>"></script>
    <?php endif; ?>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql_two";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
?>
