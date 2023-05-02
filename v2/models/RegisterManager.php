<?php

class RegisterManager extends database {
    public function __construct($host, $username, $password, $database) {
        parent::__construct($host, $username, $password, $database);
    }

    public function getRegister() {
        // session_start();
        return;
    }
}