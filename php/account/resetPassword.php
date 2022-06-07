<?php 
    include '../database/connect.php';
    include '../database/tokenHandler.php';
    include '../../baseObjects/scripts/scripts.php';
    $prefix = '../../';
    include '../../baseObjects/search.php';

    if(isset($_POST['Send'])) {
        $email = $_POST['Email'];
        a:
        $randomUrl = randomString(25);
        $sqlGetVal = "SELECT `url` FROM `passreset` WHERE `url` = '$randomUrl'";
        $result = mysqli_query($conn, $sqlGetVal) or die(mysqli_error($conn));
        if (!mysqli_num_rows($result) > 0) {
           $sqlPostRequest = "INSERT INTO `passreset`(`email`, `url`) VALUES ('$email','$randomUrl')";
           mysqli_query($conn, $sqlPostRequest) or die(mysqli_error($conn));
        } else {
            $values = mysqli_fetch_all($result);
            print_r($values);
            goto a;
        }
        // if ()
    }
    
?>

<!DOCTYPE html>
<html> 
    <head>
        <?php include "../../baseObjects/mainHead.php"?>

        <link href="../../css/cont.css" rel="stylesheet">
    </head>
    <body style='background-color: #7cc29a;' >
        <div class="topNav">
            <div class="topNavCategories">
                <div class='topNavCategoriesLeft'>
                    <img src="../../assests/myHomework-transparentLowest.png" class="topNavLogo" onclick="window.location = '../../index.php'">
                    <button id="topNavButton" onclick="window.location = '../../index.php'">Acasă</button>
                    <button id="topNavButton" onclick="window.location = '../../leaderboard.php'">Leaderboard</button>
                    <button id="topNavButton" onclick="window.location = '../../contact.php'">Contact</button>
                    <button id="topNavButton" onclick="window.location = '../../despre.php'">Despre</button>
                </div>
                <div class='connectDiv'>
                    <form method="GET" class='searchDiv'>
                        <input type='search' placeholder="Cauta-ti intrebarea aici" name='search'>
                        <input type='submit' value='OK' name='searchSubmit' id='searchSubmit' style='display:none'>
                        <button><label for='searchSubmit' style="cursor: pointer;"><i class="fas fa-search"></i></label></button>
                    </form>
                    <button id='ConnectButton' onclick='window.location = "../../php/addIntrebare.php"'>Adaugă</button>
                    <button id='ConnectButton' onclick='window.location = "../../php/cont.php"'><?php if ($userAccount == []) {echo 'Cont';} else {echo 'Conectare';}?></button>
                </div>
            </div>
            
        </div>
        <div class='mainDiv'>
            <form class='loginDiv' id='login' action='' method='POST'>
                <label><span style="color: red;">*</span> Email</label><br>
                <input type="email" name='Email' required><br>
                <input type='submit' value="Trimite" name='Send'><br>
                <div class='loginDivBottom'>
                    <a onclick="back()">Inapoi</a>
                </div>
            </form>
        </div>
        <div class='bottomDiv'>
            <p style="color: white;">ASA</p>
        </div>
        <script>
            function back() {
                window.location = '../cont.php';
            }
        </script>
        <?php include '/xampp/htdocs/baseObjects/footer.php' ?>
    </body>
</html>