<?php
require_once 'BaseController.php';

class SignupController extends BaseController {
    public function indexAction() {
        $this->render('signup');
    }
}
?>