<?php
class View {
    private $_file;
    private $_t;

    public function __construct($action) {
        $this->_file = 'vues/view'.$action.'.php'; //METTRE BON DEBUT DE NOM DE FICHIER
    }

    public function displayError($error) {
        echo $error;
    }

    public function generate($data = array()) {
        $content = $this->generateFile($this->_file, $data);
        $view = $this->generateFile('vues/template.php', array('content' => $content));
        echo $view;
    }

    private function generateFile($file, $data = array()) {
        if (file_exists($file)) {
            if (is_array($data)) {
                extract($data);
            }
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else {
            throw new Exception('Fichier '.$file.' introuvable');
        }
    }
    
}