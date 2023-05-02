<?php
require_once("database.php");

// Récupération de la requête de recherche
$searchQuery = isset($_GET["q"]) ? $_GET["q"] : "";
$type_ = isset($_GET["type"]) ? $_GET["type"] : "";
$meridien_ = isset($_GET["meridien"]) ? $_GET["meridien"] : "";
$caract_ = isset($_GET["caract"]) ? $_GET["caract"] : "";
$limit_ = isset($_GET["limit"]) ? $_GET["limit"] : 100;
$page = isset($_GET["page"]) ? $_GET["page"] : "home";

$sql = "SELECT DISTINCT sP.ids, s.desc AS symptome_desc, p.mer, p.type, p.desc AS patho_desc,m.nom,m.element FROM keywords k inner join keySympt kS on k.idk = kS.idk 
inner join symptome s on kS.ids = s.ids inner join symptPatho sP on s.ids = sP.ids inner join patho p on p.idp = sP.idp 
inner join meridien m on p.mer = m.code WHERE k.name ilike $1";

$params = array('%' . $searchQuery . '%');
$counter = 1;

if (!empty($type_)) {
    $counter += 1;
    $sql .= " AND p.desc ilike $" . $counter;
    $params[] = '%' . $type_ . '%';
}
if (!empty($meridien_)) {
    $counter += 1;
    $sql .= " AND m.nom = $" . $counter;
    $params[] = $meridien_;
}
if (!empty($caract_)) {
    $counter += 1;
    $sql .= " AND p.desc ilike $" . $counter;
    $params[] = '%' . $caract_ . '%';
}

if ($page == "home") {
    $result = $database->prepare_execute($sql .= " Limit 10", $params);
} else {
    $result = $database->prepare_execute($sql .= " Limit 500", $params);
}

$resultsArray = array();
if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        $resultsArray[] = array(
            "id_symp" => $row["ids"],
            "desc" => $row["symptome_desc"],
            "merCode" => $row["mer"],
            "type" => $row["type"],
            "desc2" => $row["patho_desc"],
            "merName" => $row["nom"],
            "merElem" => $row["element"],
            "fav" => false,
        );
    }
}

session_start();
if(isset($_SESSION['id'])){
    $sql = "SELECT id_sympt FROM tj_users_sympt WHERE id_user = $1";
    $params = array($_SESSION['id']);
    $fav = $database->prepare_execute($sql, $params);

    $favIds = array();
    while ($row = pg_fetch_assoc($fav)) {
        $favIds[] = $row['id_sympt'];
    }

    foreach ($resultsArray as &$item) {
        if (in_array($item['id_symp'], $favIds)) {
            $item['fav'] = true;
        }
    }
    unset($item);
}

// Encodage du tableau en JSON et renvoi de la réponse
header('Content-Type: application/json; charset=utf-8');
echo json_encode($resultsArray, JSON_UNESCAPED_UNICODE);



?>
