<?php

    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $request = "SELECT * FROM users WHERE mail LIKE '" . $mail . "';";
    $result = $database->query($request);
    $row = $database->fetch($result);
    $hash = $row['passwd'];
        
    if (password_verify($password,$hash)) {
        header('Location: index.php');
        $_SESSION['id'] = $row['id'];
    } else {
        // echo '<h1>Erreur de connexion</h1>';
        header('Location: index.php?page=login&error=true');
    }

?>
