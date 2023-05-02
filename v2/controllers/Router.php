<?php
require_once('vues/View.php');

class Router {
    private $_ctrl;
    private $_view; //ON RECUPERERA LA VUE AVEC CET ATTRIBUT PLUS TARD

    public function routeReq() {
        try {
            // Chargement automatique des classes
            spl_autoload_register(function($class){
                require_once('models/'.$class.'.php');
            });

            $url = array('');

            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "controllers/". $controllerClass .".php";

                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }
                else {
                    throw new Exception('Page introuvable');
                }
            }
            else {
                require_once('controllers/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }
        }
        catch(Exception $e) {
            $errorMsg = $e->getMessage();
            require_once('vues/viewError.php');
        }
    }
}