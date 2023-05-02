<?php

class AccueilManager extends database {
    public function __construct($host, $username, $password, $database) {
        parent::__construct($host, $username, $password, $database);
    }

    public function getAccueil() {
        // session_start();
        return;
    }
}