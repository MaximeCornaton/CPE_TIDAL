<?php

class LoginManager extends database {
    public function __construct($host, $username, $password, $database) {
        parent::__construct($host, $username, $password, $database);
    }

    public function getLogin($mail) {
        $request = "SELECT * FROM users WHERE mail LIKE '" . $mail . "';";
        $result = $this->query($request);
        if (isset($result)) {
            $row = $this->fetch($result);
            $hash = $row['passwd'];
            return array($hash, $row['id']);
        }
        else {
            return false;
        }
    }
}