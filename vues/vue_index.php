<div class="sctn-search-bar">
    <?php
    if (isset($_SESSION['id'])) { ?>
    <div class="sctn-search-bar-content">
        
        <div class="sctn-search-bar-content-search">
            <form action="diseases.php" class="sctn-search-bar-content-search-input">
                <input type="text" placeholder="Rechercher à partir de symptomes..." name="search" autocomplete="off">
            </form>
        
        </div>
        <div class="sctn-search-bar-find">
            <template id="list-results">
                <div class="sctn-search-result">
                    <a href="disease.php?id={{id}}">{{description}}</a>
                </div>
            </template>
        </div>
    </div>
    <?php
    }else{
        require_once("form-signin.html");
    } ?>
    
</div>