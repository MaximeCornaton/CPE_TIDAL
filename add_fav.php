<?php
 if(isset($_GET['id']) && isset($_GET['action'])){
    session_start();
    require_once("database.php");
    if(isset($_SESSION['id'])){
        if($_GET['action'] == "add"){
            $sql = "INSERT INTO tj_users_sympt (id_user, id_sympt) VALUES ($1, $2)";
            $params = array($_SESSION['id'], $_GET['id']);
            $result = $database->prepare_execute($sql, $params);
            if($result){
                echo "added";
            } else {
                echo "error";
            }
        }
        else{
            $sql = "DELETE FROM tj_users_sympt WHERE id_user = $1 AND id_sympt = $2";
            $params = array($_SESSION['id'], $_GET['id']);
            $result = $database->prepare_execute($sql, $params);
            if($result){
                echo "removed";
            } else {
                echo "error";
            }
        }
    }
 }