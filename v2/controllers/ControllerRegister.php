<?php
class ControllerRegister {
    private $_registerManager;
    private $_view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        }
        else {
            $this->register();
        }
    }

    private function register() {
        require_once('config.php');
        $this->_registerManager = new RegisterManager($host, $username, $password, $database);
        $register = $this->_registerManager->getRegister();

        $this->_view = new View('Register');
        $this->_view->generate(array('register' => $register));
    }
}