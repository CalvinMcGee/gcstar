<?php

class AppController extends Controller {

    function beforeFilter(){
        $this->view = 'Theme';
        $this->theme = Configure::read('Visual.theme');
    }
}
?>