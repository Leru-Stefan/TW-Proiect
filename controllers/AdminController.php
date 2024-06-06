<?php
require_once 'BaseController.php';

class AdminController extends BaseController {
    public function indexAction() {
        $this->checkAuthentication();
        $this->render('admin');
    }
}
?>