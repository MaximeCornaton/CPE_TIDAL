<?php
class ControllerProfile {
    private $_profileManager;
    private $_view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        }
        else {
            $this->profile();
        }
    }

    private function profile() {
        require_once('config.php');
        $this->_profileManager = new ProfileManager($host, $username, $password, $database);
        $profile = $this->_profileManager->getProfile();

        $this->_view = new View('Profile');
        $this->_view->generate(array('profile' => $profile));
    }
}