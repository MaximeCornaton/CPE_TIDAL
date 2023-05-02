<?php 
require_once("models/database.php");
session_start();

require_once("vues/header.php"); 

    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }
    else{
        $page = "";
    }

    if(isset($_GET["error"])){
        $error = $_GET["error"];
    }
    else{
        $error = "false";
    }

    switch ($page)
        {
            case "login" :
                include 'vues/vue_login.php';
                break;

            case "signin" :
                include 'vues/vue_signin.php';
                break;
        
            case "vue_index" :
                include 'vues/vue_index.php';
                break;

            case "login_user" :
                include 'models/login_user.php';
                break;
            
            case "register_user" :
                include 'models/register_user.php';
                break;

            case "profile" :
                if(!isset($_SESSION['id'])){
                    header('Location: index.php?page=login');
                    exit();
                }
                else{
                    include 'profile.php';
                }
                break;

            case "about" :
                include 'vues/vue_about.html';
                break;
                
            default:
                include 'vues/vue_index.php';
                break;

            }

 require_once("vues/footer.html"); 

 $database->close();

?>