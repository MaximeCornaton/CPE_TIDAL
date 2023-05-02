<?php
if (!isset($_SESSION['id'])) {
    require_once("form-login.html");
}
else {
    require_once("vue_about.html");
    exit;
}
?>