<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AAA">
    <meta name="keywords" content="AAA, acupuncture, symptomes, meridiens, meridien, symptome">
    <meta name="authors" content="Aubry Paul, Barriquand Valentin, Chausson Adrien, Cornaton Maxime, Lajugie Rodolphe">

    <meta property="og:title" content="AAA">
    <meta property="og:description" content="AAA">
    <!-- <meta property="og:image" content="https://example.com/image.jpg">
    <meta property="og:url" content="https://example.com"> -->
    <meta property="og:type" content="website">

    <!-- <link rel="canonical" href="https://example.com"> -->
    <link rel="shortcut icon" href="assets/favicon.png">


    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/header.css?">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/disease.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/diseases.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-L4LpweD+CgZfPxONd/ZeW7rOeuT0TtLsEhrYkWeDOOeyQ+PmGZ7iQ0IBdyEbR7jK1IaB1vgdEDYAd0e0j+13ug==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- <script src="js/about.js" defer></script> -->
    <!-- <script src="js/diseases.js" defer></script> -->
    <script src="js/header.js" defer></script>
    <!-- <script src="js/home.js" defer></script>
    <script src="js/profile.js" defer></script> -->
    
    <script src="https://kit.fontawesome.com/1674cf8216.js" crossorigin="anonymous" defer></script>

    <title>AAA</title>
</head>
<body>

<header id="header">
    <h1><a id="navbar-title" href="index.php">AAA</a></h1>
    <nav class="header-nav">
        <a href="index.php">HOME</a>
        <a href="index.php?page=diseases">PATHOLOGIES</a>
        <a href="index.php?page=about">A PROPOS</a>
    </nav>
    <div class="connect">
        <?php 
        
        if (isset($_SESSION['id'])) {
            echo '<a class="login-ico" href="index.php?page=profile"><i class="fa-solid fa-circle-user"></i></a>';
        }
        else {
            echo '<a class="user conn" href="index.php?page=login">CONNEXION</a> ';
            echo '<a class="user insc" href="index.php?page=signin">INSCRIPTION</a>';
        }
        ?>
        
    </div>
</header>
<div class="space"></div>