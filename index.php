<?php 
    include 'php/database/connect.php';
    include 'baseObjects/scripts/scripts.php';
    include 'baseObjects/scripts/transformators.php';
    include 'php/database/tokenHandler.php';

    $searchCondition = 0;
    $prefix = '';
    include 'baseObjects/search.php';

    $sql='SELECT * FROM intrebari';
    if ($searchCondition != 0) {
        $sql .= " WHERE title like '%$search%'";
    }
    $sql .= " ORDER BY id DESC";
    
    $result = mysqli_query($conn, $sql);
    $articole = mysqli_fetch_all($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include "baseObjects/mainHead.php"?>

        <link href="css/index.css" rel="stylesheet">
        <link href="css/articole.css" rel="stylesheet">
        <script src="js/index.js" defer></script>
    </head>
    <body style='background-color: #7cc29a;'>
        <?php include 'baseObjects/navbar.php'?>
        <div class="mainDiv">
            <div class="mainTopDiv" id='mainDiv'>
                <?php    
                    if (isset($userAccount)) {
                        echo '<script>document.getElementById("mainDiv").setAttribute("style", "display:none")</script>';
                    }   
                ?>
                <h1>Bine ai venit!</h1>
                <p>Pentru a incepe te rugam sa te conectezi sau sa iti faci un cont (Nu este obligatoriu, dar nu vei putea intreba, comenta si raspunde).</p>
            </div>
            <div class="container">
                <div class='articole'>
                    <?php foreach($articole as $articol) { ?>
                        <?php
                            $articolObj = convert_obj($articol, $dbConfig->intrebari);
                            $artEmail = $articolObj -> user;
                            $getAccSQL = "SELECT `password`, `image`, `name`, `tokenID` FROM `conturi` WHERE email = '$artEmail'";
                            $getResult = mysqli_query($conn, $getAccSQL) or die(mysqli_error($conn));
                            $getAcc = mysqli_fetch_object($getResult);
                            $getPass = $getAcc -> password;
                            $getImg = $getAcc -> image;
                            $getName = $getAcc -> name;
                            $getTokenID = $getAcc -> tokenID;
                            
                            $materie = matIdToName($articolObj -> materie);
                            $timp = timeToACT($articolObj -> time);
                            $interact = json_decode($articolObj -> likes);
                            $likes = allToLikeCount($interact->likes, $interact->dislikes);
                        ?>
                        <div class='articol'>
                            <div class='topArticol'>
                                <div>
                                    <img src='uploads/conturi/<?php echo $getImg?>' class='articolImg' style="cursor: pointer;" onclick="window.location = 'php/profile.php?target=<?php echo md5($artEmail) ?>'">
                                </div>
                                <div>
                                    <div class='topText'>
                                        <p><span class='userName' onclick="window.location = 'php/profile.php?target=<?php echo md5($artEmail) ?>'"><?php echo $getName ?></span><span><br><?php echo $materie ?> • Acum <?php echo $timp ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <h1 onclick="<?php echo 'window.location = `php/loadIntrebare.php?id='.$articol[0].'`';?>"><?php echo htmlspecialchars($articol[1])?></h1>
                            <p><?php echo htmlspecialchars($articol[2])?></p>
                            <div class='articolInteraction'>
                                <img src='assests/like2.svg' width="20px" style="filter: invert(20%) sepia(94%) saturate(3535%) hue-rotate(148deg) brightness(90%) contrast(101%);pointer-events:none;user-select:none">
                                <p style='font-weight:bold;'><?php echo $likes; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php 
                    if (empty($articole)) { echo '<div class="noResults"><h1>No Results</h1></div>';}
                ?>
            </div>
        </div>        
        <div id='filtruMaterii'>
            <button class="materiiButton" value="all" class="active">Tot</button>
            <button class="materiiButton" value="bio">Biologie</button>
            <button class="materiiButton" value="chi">Chimie</button>
            <button class="materiiButton" value="ses">Desen/Educatie Plastica</button>
            <button class="materiiButton" value="eng">Engleza</button>
            <button class="materiiButton" value="spo">Educatie Fizica/Sport</button>
            <button class="materiiButton" value="fiz">Fizica</button>
            <button class="materiiButton" value="fra">Franceza</button>
            <button class="materiiButton" value="geo">Geografie</button>
            <button class="materiiButton" value="ger">Germana</button>
            <button class="materiiButton" value="inf">Informatica</button>
            <button class="materiiButton" value="ist">Istorie</button>
            <button class="materiiButton" value="ita">Italiana</button>
            <button class="materiiButton" value="log">Logica</button>
            <button class="materiiButton" value="mat">Matematica</button>
            <button class="materiiButton" value="muz">Muzica/Educatie Muzicala</button>
            <button class="materiiButton" value="rel">Religie</button>
            <button class="materiiButton" value="rom">Romana</button>
            <button class="materiiButton" value="spa">Spaniola</button>
            <button class="materiiButton" value="tic">TIC</button>
            <button class="materiiButton" value="oth">Altele</button> 
        </div>
        <?php include '/xampp/htdocs/baseObjects/footer.php' ?>
    </body>
</html>