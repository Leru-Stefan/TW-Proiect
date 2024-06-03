<?php
require_once 'BaseController.php';

class EditorController extends BaseController {
    public function indexAction() {
        $this->render('editor');
    }
}
?>