<?php

class ProfileManager extends database {
    public function __construct($host, $username, $password, $database) {
        parent::__construct($host, $username, $password, $database);
    }

    public function getProfile() {
        $query = "SELECT last_name, first_name, mail, LPAD(EXTRACT(day FROM created_at)::text, 2, '0') || '/' || LPAD(EXTRACT(month FROM created_at)::text, 2, '0') || '/' || EXTRACT(year FROM created_at) AS created_at
        FROM users WHERE id = $1";
        $result = $database->prepare_execute($query, array($_SESSION['id']));
        $row = $database->fetch($result);
        return array($row['last_name'], $row['first_name'], $row['mail']);
        // REPRENDRE ICI
    }
}