<?php
// public/index.php
session_start();
require_once './controllers/BaseController.php';
require_once './models/Database.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'landing';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerName = ucfirst($page) . 'Controller';
$controllerFile = 'controllers/' . $controllerName . '.php';
$actionMethod = $action . 'Action';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();

    if (method_exists($controller, $actionMethod)) {
        $controller->$actionMethod();
    } else {
        echo "Acțiunea nu există.";
    }
} else {
    echo "Controlerul nu există: " . $controllerFile;
}
?>


