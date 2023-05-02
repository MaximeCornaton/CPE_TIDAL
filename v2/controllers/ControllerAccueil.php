<?php
class ControllerAccueil {
    private $_accueilManager;
    private $_view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        }
        else {
            $this->accueil();
        }
    }

    private function accueil() {
        require_once('config.php');
        $this->_accueilManager = new AccueilManager($host, $username, $password, $database);
        $accueil = $this->_accueilManager->getAccueil();

        $this->_view = new View('Accueil');
        $this->_view->generate(array('accueil' => $accueil));
        // require_once('vues/vue_index.php');
    }
}