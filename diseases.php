<?php
    require_once("database.php");
    
    $query2 = "SELECT code, nom, element from meridien ORDER BY nom ASC";
    $meridiens = $database->query($query2);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAA | PATHOLOGIES</title>
    <link rel="icon" type="image/png" href="assets/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/diseases.css"/>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/footer.css">

    <script src="js/header.js" defer></script>
    <script src="js/diseases.js" defer></script>

    <script src="https://kit.fontawesome.com/1674cf8216.js" crossorigin="anonymous" defer></script>
</head>
<body>
    <?php require_once("header.php"); ?>
    <h2 class="page-title">Pathologies</h2>

    <section class="filters-section">
    <?php if (isset($_SESSION['id'])) { ?> 
        <input id="ssearch" type="text" placeholder="Rechercher à partir de symptomes..." name="search" autocomplete="off">
    <?php } else {?>
        <input id="ssearch" type="text" placeholder="Connectez vous pour rechercher des symptomes..." name="search" autocomplete="off" disabled>
    <?php } ?>
        <form>
            <span class="filter-title">filtrer par :</span>

            <select name="type" id="type" class="select-filter">
                <option value="">- Type</option>
                <option value="méridien">méridien</option>
                <option value="fu">organe/viscère</option>
                <option value="luo">luo</option>
                <option value="pathologie">merveilleux vaisseaux</option>
                <option value="jing jin">jing jin</option>
            </select>
            <select name="meridien" id="mer" class="select-filter">
                <option value="">- Méridien</option>
                <?php 
                while ($row = $database->fetch($meridiens)) {
                    echo "<option value='$row[nom]'>$row[nom]</option>";
                 } 
                 ?>
            </select>
            <select name="caract" id="desc" class="select-filter">
                <option value="">- Caractéristique</option>
                <option value="interne">interne</option>
                <option value="externe">externe</option>
                <option value="plein">plein</option>
                <option value="vide">vide</option>
                <option value="chaud">chaud</option>
                <option value="froid">froid</option>
            </select>

        <button class="reset-filters">Effacer</button>
        </form>

        </section>

    <section class="filter-show-diseases">

<?php
    if ($database->isTableNotEmpty("patho")) { ?>

        <table >
        <thead id="table-results">
            <tr>
                <th>Symptomes</th>
                <th>Méridien</th>
                <th>Type/Catégorie</th>
                <th>Caractéristiques</th>
                <?php if (isset($_SESSION['id'])) { ?>
                <th>Favoris</th>
                <?php } ?>
            </tr>
        </thead>
        
        <template id="template-results-page">
        <tr>
            <td>{{desc}}</td>
            <td>{{merCode}} - {{merName}} - {{merElem}}</td>
            <td>{{type}}</td>
            <td>{{desc2}}</td>
            <?php if (isset($_SESSION['id'])) { ?>
            <td style="text-align: center; vertical-align: middle;"><span onclick="update_fav({{id}})" class="fav-button"><i id="{{id}}" class="{{fav}}"></i></span></td>
            <?php } ?>
            </tr>
        </template>
        <tbody class="list-results-page">


        </tbody>
    </table>
    
    <?php 
    } else {
        echo "Aucune pathologie trouvée.";
    }
    ?>
</section>


</body>
</html>

<?php require_once("footer.php"); ?>
