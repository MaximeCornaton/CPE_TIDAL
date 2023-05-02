<!-- Reprendre, on obtient tous les mots de passe et adresse mail -->
<?php
    require_once("../models/database.php");
    $request_method = $_SERVER["REQUEST_METHOD"];

    $idSearch = isset($_GET["id"]) ? $_GET["id"] : "";

    if (empty($idSearch)){
        $query = 'SELECT * FROM users';
        $result = $database->prepare_execute($query, array());
        $result = pg_fetch_all($result);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }else{
        $sql = 'SELECT * FROM users where id=$1';
        $params = array($_GET['id']);
        $result = $database->prepare_execute($sql,$params);
        $result = pg_fetch_all($result);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
?>