<?php
require_once 'BaseController.php';

class ProblemeController extends BaseController {
    public function indexAction() {
        $this->render('probleme');
    }
}
?>