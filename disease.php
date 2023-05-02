<?php
require_once("database.php");
$idSearch = isset($_GET["id"]) ? $_GET["id"] : ""; 


        if (!empty($idSearch)) {
            $query = "SELECT sy.desc as sydesc, p.mer, p.type, p.desc as pdesc from symptome sy inner join symptPatho s on sy.ids = s.ids
                inner join patho p on p.idp = s.idp where sy.ids = $1";
            $result = $database->prepare_execute($query, array($idSearch));
            $result = pg_fetch_all($result);
        }
        else{
             header("Location: diseases.php");
        }
?>


    <?php 
        require_once("header.php");
    ?>

    <section class="patho">
            <h2 class = "page-title"><?php echo $result[0]["sydesc"]; ?></h2>
            <section class="results">
                <div class="rows">
                    <span>Type</span>
                    <div class="mer"><?php 
                        foreach ($result as $row) { ?>
                            <span>
                                <?php echo $row['type']; ?>
                            </span>
                            <?php }
                            ?>
                    </div>
                </div>
                <div class="rows">
                    <span>Méridien</span>
                    <div class="mer"><?php 
                        foreach ($result as $row) { ?>
                        <span>
                            <?php echo $row['mer']; ?>
                        </span>
                        <?php }
                        ?>
                    </div>
                </div>
                <div class="rows">
                    <span>Déscription</span>
                    <div class="mer"><?php 
                        foreach ($result as $row) { ?>
                            <span>
                                <?php echo $row['pdesc']; ?>
                            </span>
                            <?php }
                            ?>
                    </div>
                </div>
            </section>
    
    </section>
            
    <?php require_once("footer.php"); ?>
    
