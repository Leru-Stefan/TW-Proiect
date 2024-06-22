<?php
require_once 'BaseController.php';

class AjutorController extends BaseController {
    public function indexAction() {
        $this->checkAuthentication();
        $this->render('ajutor');
    }
}
?>