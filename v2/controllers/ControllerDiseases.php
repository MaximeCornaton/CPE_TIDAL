<?php
class ControllerDiseases {
    private $_diseaseManager;
    private $_view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        }
        else {
            $this->diseases();
        }
    }

    private function diseases() {
        require_once('config.php');
        $this->_diseaseManager = new DiseaseManager($host, $username, $password, $database);
        $diseases = $this->_diseaseManager->getDiseases();
        $meridiens = $this->_diseaseManager->getMeridiens();
        foreach($meridiens as $meridien):
            $meridien = $meridien->getNom();
        endforeach;

        try {
            $is_patho = $this->_diseaseManager->isPathoTableNotEmpty();
            $error = 'Tout est bon';
        } catch (Exception $e) {
            // Afficher l'erreur ici ou faire une redirection vers une page d'erreur
            $error = 'Une erreur est survenue : '.$e->getMessage();
            return;
        }

        $this->_view = new View('Diseases');
        $this->_view->displayError(json_encode(array('diseases' => $diseases, 'meridiens' => $meridiens, 'is_patho' => $is_patho)));
        $this->_view->generate(array('diseases' => $diseases, 'meridien' => $meridien, 'is_patho' => $is_patho));
        // require_once('vues/vue_index.php');
    }
}