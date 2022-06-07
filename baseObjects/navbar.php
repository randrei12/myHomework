        <div class="topNav">
            <div class="topNavCategories">
                <div class='topNavCategoriesLeft'>
                    <img src="/assests/myHomework-transparentLowest.png" class="topNavLogo" onclick="window.location = '/index.php'">
                    <button id="topNavButton" onclick="window.location = '/index.php'">Acasă</button>
                    <button id="topNavButton" onclick="window.location = '/leaderboard.php'">Leaderboard</button>
                    <button id="topNavButton" onclick="window.location = '/contact.php'">Contact</button>
                    <button id="topNavButton" onclick="window.location = '/despre.php'">Despre</button>
                </div>
                <div class='connectDiv'>
                    <form method="GET" class='searchDiv'>
                        <input type='search' placeholder="Cauta-ti intrebarea aici" name='search'>
                        <input type='submit' value='OK' name='searchSubmit' id='searchSubmit' style='display:none'>
                        <button><label for='searchSubmit' style="cursor: pointer;"><i class="fas fa-search"></i></label></button>
                    </form>
                    <button id='ConnectButton' onclick='window.location = "/php/addIntrebare.php"'>Adaugă</button>
                    <?php 
                        if (isset($userAccount)) {
                            echo '<script>document.getElementById("ConnectButton").setAttribute("style", "display:none")</script>';
                        }
                    ?>
                    <button id='ConnectButton' onclick='window.location = "/php/cont.php"'><?php if (isset($userAccount)) {echo 'Cont';} else {echo 'Conectare';}?></button>
                </div>
            </div>
        </div>