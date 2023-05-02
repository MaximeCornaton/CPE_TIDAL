<?php

abstract class Model {
    private static $_bdd;

    private static function setBdd() {
        // require_once('config.php');
        self::$_bdd = new database("localhost", "pgtp", "pgtp", "postgres");
    }    

    protected function getBdd() {
        if (self::$_bdd == null) {
            self::setBdd();
        }
        return self::$_bdd;
    }

    function getAll($table, $obj) {
        $var = [];
        $query = "SELECT * FROM " . $table . " ORDER BY nom ASC";
        $req = self::$_bdd->query($query);
        
        while ($data = pg_fetch_assoc($req)){
            $var[] = new $obj($data);
        }
        pg_free_result($req);
        return $var;
    }

    function notEmpty($table) {
        return self::$_bdd->isTableNotEmpty($table);
    }
    

}
