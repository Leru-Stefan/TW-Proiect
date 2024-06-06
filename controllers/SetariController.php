<?php
require_once 'BaseController.php';

class SetariController extends BaseController {
    public function indexAction() {
        $this->checkAuthentication();
        $this->render('setari');
    }
}
?>