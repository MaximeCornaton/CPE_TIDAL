<?php
class ControllerLogin {
    private $_loginManager;
    private $_view;
    private $_logged;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        }
        else {
            $this->login();
        }
    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
    

    private function login() {
        require_once('config.php');
        $this->_loginManager = new LoginManager($host, $username, $password, $database);
        $this->_logged = false;
        // Vérifiez si les données POST sont soumises
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données POST soumises
            $mail = $_POST['mail'];
            $password = $_POST['password'];
    
            // Vérifier si l'utilisateur existe dans la base de données
            list($hash, $user) = $this->_loginManager->getLogin($mail);

            if ($hash != false) {
                // Vérifier si le mot de passe est correct
                if (password_verify($password, $hash)) {
                    // Le mot de passe est correct, créer une session pour l'utilisateur
                    session_start();

                    $_SESSION['id'] = $user;
                    $this->_logged = true;
    
                    // Rediriger l'utilisateur vers la page d'accueil
                    //header('Location: ../index.php');
                    $this->debug_to_console("testtttt");

                }
            }
        }


        if ($this->_logged == false) {
    
            $this->_view = new View('Login');
            $this->_view->generate(array('login' => ''));
        }
        else {
            // Si l'authentification échoue, afficher un message d'erreur sur la page de connexion
            $this->_view = new View('Login');
            $this->_view->generate(array('error' => 'Identifiants incorrects'));
        }
    }
    
}