<?php

class AboutManager extends database {
    public function __construct($host, $username, $password, $database) {
        parent::__construct($host, $username, $password, $database);
    }

    public function getAbout() {
        return;
    }
}