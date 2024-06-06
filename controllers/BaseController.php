<?php
class BaseController {
    protected function checkAuthentication() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }
    }

    protected function render($view, $data = []) {
        extract($data);
        require 'views/' . $view . '.php';
    }
}
?>
