<?php
require_once 'BaseController.php';

class ProfileController extends BaseController {
    public function indexAction() {
        $this->render('profile');
    }
}
?>