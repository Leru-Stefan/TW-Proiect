<?php
require_once 'BaseController.php';

class LandingController extends BaseController {
    public function indexAction() {
        $this->render('landing');
    }
}
?>
