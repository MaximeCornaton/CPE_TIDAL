<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: profile.php');
    exit();
}
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];
if ($newPassword !== $confirmPassword) {
    echo "Les mots de passe ne correspondent pas.";
    exit;
}

$query = "SELECT passwd FROM users WHERE id = $1";
$result = $database->prepare_execute($query, array($_SESSION['id']));
$row = $database->fetch($result);
$hash = $row['passwd'];
if (password_verify($_POST['old_password'],$hash)) {
    $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $query = "UPDATE users SET passwd = $1 WHERE id = $2";
    $result = $database->prepare_execute($query, array($newHash, $_SESSION['id']));
    header('Location: profile.php');
    exit();
} else {
    header('Location: profile.php?page=' . urlencode('password') . '&error=' . urlencode('true'));
    exit();
}
?>