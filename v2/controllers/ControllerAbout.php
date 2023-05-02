<?php
class ControllerAbout {
    private $_aboutManager;
    private $_view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        }
        else {
            $this->about();
        }
    }

    private function about() {
        require_once('config.php');
        $this->_aboutManager = new AboutManager($host, $username, $password, $database);
        $about = $this->_aboutManager->getAbout();

        $this->_view = new View('About');
        $this->_view->generate(array('about' => $about));
    }
}