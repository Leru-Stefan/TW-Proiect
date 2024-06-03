<?php
require_once 'BaseController.php';

class LoginController extends BaseController {
    public function indexAction() {
        $this->render('login');
    }
}
?>