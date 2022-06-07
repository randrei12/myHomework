<?php 
    include 'database/connect.php';
    include 'database/tokenHandler.php';
    // include '../baseObjects/scripts/scripts.php';

    // $id = $_GET['id'];

    // if (isset($_POST['requestQuesion'])) {
    //     $sql =mysqli_query($conn, "SELECT * FROM intrebari WHERE `id` = '$id'");
    //     $art = mysqli_fetch_assoc($sql);
    //     echo mysqli_num_rows($sql) != 1 ? json_encode(array('status' => 'error', 'type' => 'not found')): json_encode(array_merge(array('status' => 'success'), $art, array('publicToken' => md5($art['user']))));
    //     exit();
    // }

    // //accesat doar in AJAX
    // if (isset($_POST['imgArray'])) {
    //     $_SESSION['imaginiTotal'] = $_POST['imgArray'];
    //     $_SESSION['titluEdit'] = $_POST['titluEdit'];
    //     $_SESSION['descEdit'] = $_POST['descEdit'];
    //     exit();
    // }

    // if (isset($_POST['addQuestTitle'])) {
    //     $title = $_POST['addQuestTitle'];
    //     $desc = $_POST['addQuestDesc'];
    //     $img = $_FILES['addQuestImg'][0]['name'];

    //     echo "title: $title, desc: $desc, img: ";
    //     print_r($img);
    //     exit();
    // }

    // if(isset($_FILES['fd']['name'])) {
    //     print_r($_FILES['fd']['name']);
    //     exit();
    // } 

    // //daca a apasat like/dislike, POST venind din ajax
    // $status = 0;
    // if(isset($_POST['interaction'])) {
    //     if (isset($_COOKIE['tokenID'])) {
    //         //setam $status in functie de ce contin array-urile

    //         if (in_array($_COOKIE['tokenID'], $likesArray))
    //             $status = 1;
    //         else if (in_array($_COOKIE['tokenID'], $dislikesArray))
    //             $status = -1;
    //         else
    //             $status = 0;
            
    //         if ($_POST['interaction'] == 0) { //like
    //             if ($status == 1) { //daca este 1 inseamna ca deja a dat like, deci user-ul vrea sa si-l scoata
    //                 unset($likesArray[array_search($_COOKIE['tokenID'], $likesArray)]); //din array eliminam tokenID-ul user-ului nostru
    //                 $likesArray = array_values($likesArray); //acum resetam index-urile array-ului, ca sa nu avem nici un gap
    //                 $status = 0; //status-ul se schimba
    //             } else if ($status == 0) {  //daca este 0, inseamna ca user-ul vrea sa dea like si nu a dat nimic inainte
    //                 array_push($likesArray, $_COOKIE['tokenID']); //astfel adaugam tokenID-ul user-ului in array
    //                 $status = 1; //status-ul se schimba
    //             } else if ($status == -1) { //daca este -1, inseamna ca user-ul vrea sa dea like, dar a dat dislike inainte
    //                 array_push($likesArray, $_COOKIE['tokenID']); //adaugam like-ul in array
    //                 unset($dislikesArray[array_search($_COOKIE['tokenID'], $dislikesArray)]); //stergem dislike-ul in array
    //                 $dislikesArray = array_values($dislikesArray); //acum resetam index-urile array-ului, ca sa nu avem nici un gap
    //                 $status = 1; //status-ul se schimba
    //             }
    //         }else if ($_POST['interaction'] == 1) { //dislike
    //             if ($status == -1) { //daca este 1 inseamna ca deja a dat dislike, deci user-ul vrea sa si-l scoata
    //                 unset($dislikesArray[array_search($_COOKIE['tokenID'], $dislikesArray)]); //din array eliminam tokenID-ul user-ului nostru
    //                 $dislikesArray = array_values($dislikesArray); //acum resetam index-urile array-ului, ca sa nu avem nici un gap
    //                 $status = 0; //status-ul se schimba
    //             } else if ($status == 0) {  //daca este 0, inseamna ca user-ul vrea sa dea dislike si nu a dat nimic inainte
    //                 array_push($dislikesArray, $_COOKIE['tokenID']); //astfel adaugam tokenID-ul user-ului in array
    //                 $status = -1; //status-ul se schimba
    //             } else if ($status == 1) { //daca este -1, inseamna ca user-ul vrea sa dea dislike, dar a dat like inainte
    //                 array_push($dislikesArray, $_COOKIE['tokenID']); //adaugam dislike-ul in array
    //                 unset($likesArray[array_search($_COOKIE['tokenID'], $likesArray)]); //stergem like-ul in array
    //                 $likesArray = array_values($likesArray); //acum resetam index-urile array-ului, ca sa nu avem nici un gap
    //                 $status = -1; //status-ul se schimba
    //             }
    //         }
    //         $difference = allToLikeCount($likesArray, $dislikesArray);
    //         $totalInteraction = json_encode(["likes" => $likesArray, "dislikes" => $dislikesArray]);
    //         $inter = "UPDATE `intrebari` SET `likes`='$totalInteraction' WHERE `id` = '$id'"; 
    //         mysqli_query($conn, $inter) or die(mysqli_error($conn));
    //         echo json_encode(['status' => $status, 'diff' => $difference]);
            
    //     } else {
    //         echo '<script>alert("Trebuie sa te conectezi")</script>';
    //     }
    //     unset($_POST['interaction']);
    //     exit();

    // }
    
    // //de aici PHP ia valoarea din $_SESSION (trimisa de AJAX) si o stocheaza intr-o variabila
    // $imaginiJSON = '';
 
    // $prefix = '../';
    // include '../baseObjects/search.php';

    // $uploadTime = '';
    // $artMaterie = '';
    // $difference = 0;
    // $title = '';
    // $desc = '';
    // $img = '';

    // // $title = $articol->title;
    // // $desc = $articol->description;   
    // // $artMaterie = matIdToName($articol->materie);

    // // $hostEmail = $articol->user;
    // // $conturiSQL = "SELECT name, image, time, email, tokenID FROM conturi WHERE email = '$hostEmail'";
    // // $result2 = mysqli_query($conn, $conturiSQL);
    // // $host = mysqli_fetch_object($result2);
    // // $hostName = $host->name;
    // // $hostPhoto = $host->image;
    // // $hostProfile = md5($host->email);
    
    // // $uploadTime = timeToACT($articol->time);

    // // $imagini = loadImagesFromLocal('../uploads/intrebari/'.$id);
    
    // // //converteaza din array-ul $imagini in array-ul js 
    // // if ($imaginiJSON == '') {
    // //     $imaginiJSON = json_encode($imagini);
    // //     echo "<script>var arrayImagini = JSON.parse('$imaginiJSON')</script>";
    // // }

    // // $inter = "UPDATE `intrebari` SET `likes`='$likes',`dislikes`='$dislikes' WHERE `id` = '$id'";
    // // mysqli_query($conn, $inter) or die(mysqli_error($conn));
    // // $difference = (count($likesArray) - count($dislikesArray));

    // //adauga raspuns

    // if (isset($_POST['addRaspuns'])) {
    //     if (isset($userAccount)) {
    //         // print_r($_POST['imgInput']);
    //         $nrFiles = count($_FILES['imgInput']['name']);
    //         for ($i = 0; $i < $nrFiles; $i++) {
    //             $JSerror = ['<script>alert("', '");</script>'];;
    //             if ($_FILES['imgInput']['type'][$i] == 'image/png' || $_FILES['imgInput']['type'][$i] == 'image/gif' || $_FILES['imgInput']['type'][$i] == 'image/jpeg') {
    //                 if ($_FILES['imgInput']['size'][$i] > 5000000) {
    //                     echo $JSerror[0]. 'Marimea imaginii este prea mare('.(floor($_FILES['imgInput']['size'][$i]/1024 *100)/100).'KB)'. $JSerror[1];
    //                 } else {
    //                     $convImg;
    //                     if ($_FILES['imgInput']['type'][$i] == 'image/gif') {
    //                         $convImg = imagecreatefromgif($_FILES['imgInput']['tmp_name'][$i]);
    //                     }else if ($_FILES['imgInput']['type'][$i] == 'image/jpeg') {
    //                         $convImg = imagecreatefromjpeg($_FILES['imgInput']['tmp_name'][$i]);
    //                     }else if ($_FILES['imgInput']['type'][$i] == 'image/png') {
    //                         $convImg = imagecreatefrompng($_FILES['imgInput']['tmp_name'][$i]);
    //                     }
    //                     $currentFileNumber = 0;
    //                     while (file_exists('../uploads/comentarii/'.$id.'/'.$currentFileNumber.'.png')) {
    //                         $currentFileNumber++;
    //                     }
    //                     $filePath = '../uploads/comentarii/'.$id.'/'.$currentFileNumber.'.png';
    //                     if (!is_dir('../uploads/comentarii/'.$id)) {
    //                         $dirPath = '../uploads/comentarii/'.$id;
    //                         mkdir($dirPath, 0777, true);
    //                     }
    //                     imagepng($convImg, $filePath);
    //                     if ($img == '') {
    //                         $img = $currentFileNumber.'.png';
    //                     } else {
    //                         $img = $img.','.$currentFileNumber.'.png';
    //                     }
    //                 }
                    
    //             }else {
    //                 echo $JSerror[0].'Formatul nu este acceptat (formate acceptate: .gif, .jpg, .jpeg, .jfif, .pjpeg, .pjp, .png)'.$JSerror[1];
    //             }
    //         }
    //     } else {
    //         echo '<script>alert("Trebuie sa te conectezi ca sa poti sa raspunzi");window.location = "loadIntrebare.php?id='.$id.'";</script>';
    //     }

    //     $raspunsTitle = $_POST['raspuns'];
    //     $raspunsDesc = $_POST['descriere'];
    //     $idArticol = $_GET['id'];
    //     $idUser = $_COOKIE['tokenID'];
    //     $verifyTokenSQL = "SELECT * FROM `conturi` WHERE `tokenID` = '$idUser'";
    //     $verifyTokenResult = mysqli_query($conn, $verifyTokenSQL) or die (mysqli_error($conn));
    //     if (mysqli_num_rows($verifyTokenResult) == 1) {
    //         $sql = "INSERT INTO `comentarii`(`idArticol`, `idUser`, `Titlu`, `Descriere`, `imagini`, `like-uri`, `dislike-uri`) VALUES ('$idArticol', '$idUser', '$raspunsTitle', '$raspunsDesc', '$img', '', '')";
    //         mysqli_query($conn, $sql) or die ('<script>alert("A aparut o eroare"); location.reload()</script>');
    //         header('Location: loadIntrebare.php?id='.$idArticol);


    //     } else {
    //         echo '<script>alert("A aparut o eroare"); location.reload()</script>';
    //     }
        
    // }

    // $stergere = false;
    // $report = false;
    // $trimite = false;
    // $editeaza = false;
    // if (isset($_POST['intSub'])) {
    //     $actiune = $_POST['intSub'];
    //     if ($actiune == 'raporteaza') {
    //         $report = true;
    //     } else if ($actiune == 'editeaza') {
    //         $editeaza = true;
    //     } else if ($actiune == 'sterge') {
    //         $stergere = true;
    //     } else if ($actiune == 'trimite'){
    //         $trimite = true;
    //     }
    // }

    // //stergere

    // if (isset($_POST['deleteInteraction'])) {
    //     $optiuneAleasa = $_POST['deleteInteraction'];
    //     if ($optiuneAleasa == 'NO') {
    //         $stergere = false;
    //     } else if ($optiuneAleasa == 'YES') {
    //         $deleteSQL = "DELETE FROM `intrebari` WHERE `id` = '$id'";
    //         $delete = mysqli_query($conn, $deleteSQL);
    //         if ($delete == 1) {
    //             $deleteCommentsSQL = "DELETE FROM `comentarii` WHERE `idArticol` = '$id'";
    //             mysqli_query($conn, $deleteCommentsSQL);
    //             header('Location: ../index.php');
    //         } else {
    //             echo '<script>alert("A aparut o eroare, va rugam sa reincercati mai tarziu")</script>';
    //         }
    //     }
    // }

    // //report

    // if (isset($_POST['reportInteraction'])) {
    //     $optiuneAleasa = $_POST['reportInteraction'];
    //     if ($optiuneAleasa == 'NO') {
    //         $report = false;
    //     } else if ($optiuneAleasa == 'YES') {
    //         $email = $userAccount->email;
    //         $email_host = $hostEmail;
    //         $link = '/php/loadIntrebare.php?id='.$id;
    //         $cauza = '';
    //         $reportCommentsSQL = "INSERT INTO `reportari`(`email`, `email_host`, `link`, `cauza`) VALUES ('$email', '$email_host', '$link', '$cauza')";
    //         if (mysqli_query($conn, $reportCommentsSQL)) {
    //             echo "<script>alert('Multumim pentru informatie! De aici ne ocupam noi.')</script";
    //         } else {
    //             echo "<script>alert('A aparut o eroare, va rugam sa incercati mai tarziu.')</script";
    //         }
    //         $report = false;
    //     }
    // }
    // if (isset($_SESSION['imaginiTotal']) || isset($_SESSION['titluEdit']) || isset($_SESSION['descEdit'])) {
    //     //setam variabile pentru informatiile primite prin AJAX
    //     $titlu = $_SESSION['titluEdit'];
    //     $descriere = $_SESSION['descEdit'];
    //     $newImagini = json_decode($_SESSION['imaginiTotal']);

    //     //resetam valorile din AJAX pentru a nu se refolosi
    //     unset($_SESSION['titluEdit']);
    //     unset($_SESSION['descEdit']);
    //     unset($_SESSION['imaginiTotal']);


    //     //stocam in memoria CACHE imaginile salvate in array (deci pe cele pe care le-am decis sa le pastram)
    //     $numarulCurent = -1;
    //     $totalImagini = [];
    //     for ($nrImg = 0; $nrImg < count($newImagini); $nrImg++) {
    //         if (substr($newImagini[$nrImg], -1) == '=') {
    //             $imagineCurenta = imagecreatefromstring(base64_decode($newImagini[$nrImg]));
    //         } else {
    //             $imagineCurenta = imagecreatefrompng("../uploads/intrebari/$id/$nrImg.png");
    //         }
    //         array_push($totalImagini, $imagineCurenta);
    //         $numarulCurent++;
    //     }

    //     //stergem toate imaginile (cele pe care le dorim sa le avem in continuare sunt stocate in CACHE)
    //     if (!is_dir('../uploads/intrebari/'.$id)) mkdir('../uploads/intrebari/'.$id, 0777, false);
    //     $fisiereleDinfolder = glob('../uploads/intrebari/'.$id.'/*');
    //     foreach($fisiereleDinfolder as $fisierGasit){ // 
    //         if(is_file($fisierGasit)) {
    //             unlink($fisierGasit); 
    //         }
    //     }

    //     //cream noile imagini din cele salvate in CACHE, apoi se stergem din CACHE
    //     for ($nrImg = 0; $nrImg < count($totalImagini); $nrImg++) {
    //         imagepng($totalImagini[$nrImg], "../uploads/intrebari/$id/$nrImg.png");
    //         clearstatcache();
    //     }
    //     $imgEdit = implode(',', $totalImagini);
    //     $editeaza = false;
    //     // unset($status);
    //     echo "<script>window.location = loadIntrebare?id=$id</script>";

    //     // $editSQL = "UPDATE `intrebari` SET `title`='$titluEdit',`description`='$descEdit',`img`='$imgEdit' WHERE `id`='$id'";
    //     // mysqli_query($conn, $editSQL);
    //     // if (!mysqli_error($conn)) {
    //     //     header('Location: loadIntrebare.php?id='.$id);
    //     // } else {
    //     //     echo '<script>alert("A aparut o eroare")</script>';
    //     // }
    // }  


?>

<!DOCTYPE html>
<html>
    <head>
        <?php include "../baseObjects/mainHead.php"?>
        <meta property="og:title" content="<?php echo htmlspecialchars($title) ?>">
        <meta property="og:description" content="<?php echo htmlspecialchars($desc) ?>">
        <!-- <meta property="og:image" content="http://euro-travel-example.com/thumbnail.jpg"> -->
        <!-- <meta property="og:url" content="http://euro-travel-example.com/index.htm"> -->
        <link href="../css/loadIntrebare.css" rel="stylesheet">
        <script src="/js/loadIntrebare.js" defer></script>
    </head>
    <body>
        <?php include '../baseObjects/navbar.php'?>
        <div class="mainDiv">
            <div class='articol'>
                <div class='articolUser'>
                    <img>
                    <div class='articolUserText'>
                        <p><span class='nume'></span><br>Acum <span></span> • <span></span></>
                    </div>
                </div>
                <div class='articolText'>
                    <h1 class="articolTitle"></h1>
                    <p class="articolDesc"></p>
                </div>
                <div class='articolImg'>
                    <!-- imaginile articolului -->
                </div>
                <div class="articolActiuni">
                    <div class='interactionDiv'>
                        <button id='like' value="&#8679;"><img name='icon' src='../assests/like1.svg' width="30px" height="30px" style='filter: invert(20%) sepia(94%) saturate(3535%) hue-rotate(148deg) brightness(90%) contrast(101%);cursor:pointer'></button>
                        <p id="diffLabel"></p>
                        <button id='dislike' value="&#8681;"><img name='icon' src='../assests/like1.svg' width="30px" height="30px" style='filter: invert(20%) sepia(94%) saturate(3535%) hue-rotate(148deg) brightness(90%) contrast(101%);cursor:pointer;transform: scale(-1);'></button>
                    </div>
                    <form style="margin-block-end: 0" method="POST">
                        <?php if (isset($userAccount->tokenID)) if (md5($userAccount->tokenID) != $hostProfile) { ?>
                            <label for="raporteaza">Raporteaza</label>
                            <input type='submit' id='raporteaza' value="raporteaza" name='intSub'>
                        <?php } else { ?>
                            <label for="editeaza">Editeaza</label>
                            <input type='submit' id='editeaza' value="editeaza" name='intSub'>
                            <label for="sterge">Sterge</label>
                            <input type='submit' id='sterge' value="sterge" name='intSub'>
                        <?php } ?>
                        <label for="trimite">Trimite</label>
                        <input type='submit' id='trimite' value="trimite" name='intSub'>
                    </form>
                </div>
            </div>
            <div class='articol' style="border:none; background-color:transparent;padding:0">
                <button style='height:30px;width:130px;white-space: nowrap;text-align: center;border-radius:4px' onclick="document.getElementsByClassName('addQuestion')[0].style.display = 'flex'">Adauga un raspuns</button>
            </div>
            <?php
                // $artID = $_GET['id'];
                // $getArtSQL = "SELECT * FROM `comentarii` WHERE `idArticol` = '$artID'";
                // $getArtResult = mysqli_query($conn, $getArtSQL) or die(mysqli_error($conn));
                // $comentarii = mysqli_fetch_all($getArtResult);
            ?>
            <?php //foreach($comentarii as $comentariu) {?>
            <?php 
                // $targetTokenID = $comentariu[1];
                // $userHostSQL = "SELECT `name`, `image` FROM `conturi` WHERE `tokenID` = '$targetTokenID'";
                // $userHostResult = mysqli_query($conn, $userHostSQL) or die(mysqli_error($conn));
                // $userHost = mysqli_fetch_all($userHostResult)[0];  
                // $imagini = explode(',', $comentariu[4]);
            ?>
            <!-- <div class='articol'>
                <h1>Raspuns</h1>
                <hr width="100%">
                <div class='articolUser'>
                    <img src="../uploads/conturi/<?php echo $userHost[1]?>" onclick="window.location = 'profile.php?target=<?php echo md5($targetTokenID) ?>'">
                    <div class='articolUserText'>
                        <p><span onclick="window.location = 'profile.php?target=<?php echo md5($targetTokenID) ?>'"><?php echo $userHost[0] ?></span><br><?php echo 'Acum '.timeToACT($comentariu[7]) ?> • Expert</p>
                    </div>
                </div>
                <div class='articolText'>
                    <h1 class='articolTitle'><?php echo $comentariu[2]?></h1>
                    <p class="articolDesc"><?php echo $comentariu[3]?></p>
                </div>
                <div class="articolImg">
                    <?php //foreach ($imagini as $imagine) { 
                    //if ($imagine != '') { ?> 
                    <img src="<?php echo '/uploads/comentarii/'.$id.'/'.$imagine?>" onclick='imgClick(this.src)'>
                    <?php //}} ?>
                </div>
                <div class='interactionDiv'>
                    <button>&#8679;</button>
                    <p>100</p>
                    <button>&#8681;</button>
                </div>
            </div> -->
            <?php //} ?>
            <?php //if (count($comentarii) == 0) { ?>
                <h1 style="margin-top: 25vh; margin-bottom:25vh">Nu sunt comentarii</h1>
            <?php //} ?>
        </div>
        <div class="addQuestion" style='display:none'>
            <form>
                <h1>Adauga Raspuns</h1>
                <label for="">Raspuns</label><br>
                <input type="text" id="addQuestionTitle" required><br><br>
                <label for="">Descriere</label><br>
                <textarea  id="addQuestionDesc" cols="30" rows="10" required></textarea><br><br>
                <label for="">Imagini</label><br>
                <label class="labelUpload" for="addQuestionImg"><i class="fas fa-upload"></i></label>
                <input type="file" name='imgInput[]' id="addQuestionImg" accept="image/png, image/gif, image/jpeg" style="display: none;" multiple>
                <div class="addQuestionOpt">
                    <button onclick="location.reload()">Inapoi</button>
                    <button id='addQuestionSubmit' type="button">Adauga</button>
                </div>
            </form>
        </div>
        <?php if ($stergere == true) {?>
        <div class="articolModal">
            <div>
                <h2>Sunteti siguri ca doriti sa stergeti articolul?</h2>
            </div>
            <form class='ModalINT' method="POST">
                <button class="FalseBTN" type='submit' name='deleteInteraction' value="NO">Nu, anuleaza</button>
                <button class="TrueBTN" type='submit' name='deleteInteraction' value="YES">Da, sterge-l</button>
            </form>
        </div>
        <?php } ?>
        <?php if ($report == true) {?>
        <div class="articolModal">
            <div>
                <h2>Sunteti siguri ca doriti sa raportati acest articol?<br><span style="color: red;">ATENTIE! VA RUGAM SA NU RAPORTATI FARA MOTIV!</span></h2>
            </div>
            <form class='ModalINT' method="POST">
                <button class="FalseBTN" type='submit' name='reportInteraction' value="NO">Nu, anuleaza</button>
                <button class="TrueBTN" type='submit' name='reportInteraction' value="YES">Da, raporteaza-l</button>
            </form>
        </div>
        <?php } ?>
        <?php if ($trimite == true) {?>
        <div class="articolModal">
            <div>
                <h2>Trimite</h2>
            </div>
            <div class="shareArticol">
                <a class="fab fa-whatsapp" onclick='window.location = "whatsapp://send?text=*<?php echo $title ?>*%0a<?php echo $desc ?>%0a%0ahttps://myhomework.ro/intrebare?id=<?php echo $id ?>"' data-action="share/whatsapp/share"></a>
                <a class="fab fa-facebook-f" onclick='window.location = "https://www.facebook.com/sharer/sharer.php?u=https://www.myhomework.ro/intrebare?id=<?php echo $id ?>&t=<?php echo $title ?>"' target="_blank" ></a>
                <a class="fab fa-twitter" href="https://twitter.com/share?url=https://www.myhomework.ro/intrebare?id=<?php echo $id ?>&text=<?php echo $title ?>"></a>
                <a class="fas fa-share-alt" id='shareButton'></a>
            </div>
            <div class="copyArticolLink">
                <input value="https://www.myhomework.ro/intrebare?id=<?php echo $id ?>" readonly>
                <button onclick="navigator.clipboard.writeText('https://www.myhomework.ro/intrebare?id=<?php echo $id ?>');this.innerHTML = 'Copiat!'"><i class="fas fa-copy"></i></button>
            </div>
            <form class='ModalINT' method="POST">

            </form>
        </div>
        <?php } ?>
        <?php if ($editeaza == true) { ?>
        <div class="editModal">
            <form method="POST">
                <label>Titlu</label><br>
                <input type="text" value="<?php echo $title ?>" name='titluEdit'><br><br>
                <label>Descriere</label><br>
                <textarea rows="5" maxlength="120" name="descEdit"><?php echo $desc ?></textarea><br><br>
                <div class="editImagesDiv">
                    <?php for($k = 0; $k < count($imagini); $k++) { ?>
                    <?php if ($imagini[$k] != '') {?>
                    <div class="editImageDiv" id='editImage<?php echo $k?>'>
                        <img width="100%" height="100%" src="data:image/png;base64,<?php echo $imagini[$k]?>" style="" onclick="imgClick(this.src)">
                        <button type="button" onclick="deleteImage(<?php echo $k ?>)"><i class="fas fa-times"></i></button>
                    </div>
                    <?php }} ?>
                    <div class="editImageDiv" id='uploadImagForEdit'>
                        <label for="editImageInputFile"><img id='fff' width="100%" height="100%" src="/assests/uploadFile.png" style="border-radius:20%;cursor:pointer;" onclick=""></label>
                        <input type="file" id="editImageInputFile" name="editImageInputFile" style="display: none;" onchange="uploadImage()">
                    </div>
                </div>
                <button id='editModalSubmit' type='button' onclick="submitEdit()">Salveaza</button>
                <input type='submit' name='editIntSubmit' id='editIntSubmit' style="display: none;">
                <script>  
                function uploadImage(){
                    var imageDiv = document.createElement('div');
                    imageDiv.classList.add('editImageDiv');
                    document.getElementsByClassName('editImagesDiv')[0].appendChild(imageDiv);

                    var Uimage = document.createElement('img');
                    Uimage.setAttribute('width', '100%');
                    var currentImage = event.target.files[0];
                    var reader = new FileReader();
                    reader.onloadend = function() {
                        var base64 = reader.result.replace('data:image/png;base64,', '')
                        arrayImagini.push(base64);
                    }
                    reader.readAsDataURL(currentImage);
                    Uimage.src = URL.createObjectURL(currentImage);
                    Uimage.setAttribute('onclick', 'imgClick(this.src)')
                    imageDiv.insertBefore(Uimage, imageDiv.childNodes[1]);
                    
                    var Bimage = document.createElement('button');
                    Bimage.setAttribute('type', 'button')
                    Bimage.setAttribute('onclick', 'deleteImage(this)')
                    Bimage.innerHTML = '<i class="fas fa-times"></i>'
                    imageDiv.appendChild(Bimage)


                    
                }
                
                </script>
            </form>
        </div>
        <?php } ?>
        <?php include '/xampp/htdocs/baseObjects/footer.php' ?>
        <?php include '../baseObjects/imageModal/modal.php'?>
    </body>
    <script>
        shareButton.addEventListener("click", async () => {
            try {
                await navigator.share({text: "<?php echo $title ?>\n<?php echo $desc ?>\n", url: "https://myhomework.ro/intrebare?id=<?php echo $id ?>" });
            } catch (err) {
                console.log(err.message);
            }
        });
        function submitEdit() {
            title = document.getElementsByName('titluEdit')[0].value
            desc = document.getElementsByName('descEdit')[0].value
            $.ajax({
                    type: "POST", 
                    url: 'loadIntrebare?id=<?php echo $id ?>', 
                    data: { imgArray: JSON.stringify(arrayImagini), titluEdit: title, descEdit: desc}, 
                    dataType: 'text',
                    success: function(data) {
                        window.location.reload()
                    }
            });
        }
    </script>
    <script>
        function deleteImage(image) {
            
            
            if (!isNaN(image)) {
                document.getElementById("editImage" + image).remove();
                arrayImagini.splice(image, 1)
            } 

            if (document.getElementsByClassName("editImagesDiv")[0].childElementCount == arrayImagini.length) { //daca editImagesDiv are un singur element inseamna ca s-au sters toate pozele (ramane doar div-ul de upload)
                arrayImagini = []
            }
        }
        
    </script>
</html>

