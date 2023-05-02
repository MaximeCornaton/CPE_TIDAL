
<h2 class="page-title">Profil</h2>
<section class="profile">
    <p class="password-error">Mauvais mot de passe</p>
    <?php
    // $query = "SELECT last_name, first_name, mail, LPAD(EXTRACT(day FROM created_at)::text, 2, '0') || '/' || LPAD(EXTRACT(month FROM created_at)::text, 2, '0') || '/' || EXTRACT(year FROM created_at) AS created_at
    // FROM users WHERE id = $1";
    // $result = $database->prepare_execute($query, array($_SESSION['id']));
    // $row = $database->fetch($result);
    // A FAIRE
    if(isset($_GET['page']) && $_GET['page'] == 'modify'){ ?>
        <form class='update-form' action='modify_user.php' method='post'>
            <label for='last_name'>Nom :</label>
            <input type='text' name='last_name' id='last_name' value='<?php echo $row['last_name']; ?>' required>
            <label for='first_name'>Prénom :</label>
            <input type='text' name='first_name' id='first_name' value='<?php echo $row['first_name']; ?>' required>
            <label for='mail'>Mail :</label>
            <input type='email' name='mail' id='mail' value='<?php echo $row['mail']; ?>' required>
            <label for='password'>Mot de passe :</label>
            <input type='password' name='password' id='password' required>
            <input type='submit' value='Modifier'>
        </form>
    <?php
    }
    elseif(isset($_GET['page']) && $_GET['page'] == 'password'){ ?>
        <form class="update-form" action="update_password.php" method="post">
            <label for="old_password">Ancien mot de passe :</label>
            <input type="password" autocomplete="current-password" name="old_password" id="old_password" required>
            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" autocomplete="new-password" name="new_password" id="new_password" required>
            <label for="confirm_password">Confirmer mot de passe :</label>
            <input type="password" autocomplete="new-password" name="confirm_password" id="confirm_password" required>
            <input type="submit" value="Modifier">
        </form>
    <?php
    }
    else{ ?>
        <p>Nom : <?php echo $row['last_name']; ?></p>
        <p>Prénom : <?php echo $row['first_name']; ?></p>
        <p>Mail : <?php echo $row['mail']; ?></p>
        <p>Date de création : <?php echo $row['created_at']; ?></p>
        <div class='button-container'>
            <a class="user conn" href="profile.php?page=modify">Modifer informations</a>
            <a class="user conn" href="profile.php?page=password">Modifier mot de passe</a>
        </div>
    <?php
    }
    ?>
</section>

<section class="sctn-search-bar">

</section>

<section class="logout">
    <a class="user conn" href="logout.php">Logout</a>
</section>


