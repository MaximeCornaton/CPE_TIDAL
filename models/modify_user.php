<?php
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header('Location: profile.php');
        exit();
    }

    $query = "SELECT passwd FROM users WHERE id = $1";
    $result = $database->prepare_execute($query, array($_SESSION['id']));
    $row = $database->fetch($result);
    $hash = $row['passwd'];
    if (password_verify($_POST['password'],$hash)) {
        $query = "UPDATE users SET last_name = $1, first_name = $2, mail = $3 WHERE id = $4";
        $result = $database->prepare_execute($query, array($_POST['last_name'], $_POST['first_name'], $_POST['mail'], $_SESSION['id']));
        header('Location: profile.php');
        exit();
    } else {
        header('Location: profile.php?page=' . urlencode('modify') . '&error=' . urlencode('true'));
        exit();
    }
?>