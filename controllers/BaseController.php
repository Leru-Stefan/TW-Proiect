<?php
class BaseController {
    protected function render($view, $data = []) {
        extract($data);
        require 'views/' . $view . '.php';
    }
}
?>
