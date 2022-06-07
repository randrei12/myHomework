<?php 
    include 'database/connect.php';
    include 'database/tokenHandler.php';
    $prefix = '../';
    include '../baseObjects/search.php';

    if (isset($_POST['titluEdit'])) {
        $obj = new stdClass();
        $obj->titlu = $_POST['titluEdit'];
        $obj->description = $_POST['descEdit'];
        $obj->materii = $_POST['materii'];
        $obj->imagini = implode(',' ,json_decode($_POST['imgArray']));
        $_SESSION['addIntrebare'] = json_encode($obj);
        exit();
    }

    $JSerror = ['<script>alert("', '");</script>'];
    if (isset($_SESSION['addIntrebare'])) {
        $obj = json_decode($_SESSION['addIntrebare']);
        $titluFORM = mysqli_real_escape_string($conn, $obj->titlu);
        $descFORM = mysqli_real_escape_string($conn, $obj->description);
        $user = mysqli_real_escape_string($conn, $userAccount->email);
        $likes = mysqli_real_escape_string($conn, '{"likes":[],"dislikes":[]}');
        $matFORM = $obj->materii;
        $imgFORM = $obj->imagini;

        unset($_SESSION['addIntrebare']);

        mysqli_query($conn, "INSERT INTO `intrebari`(`title`, `description`, `user`, `materie`, `likes`) VALUES ('$titluFORM','$descFORM','$user','$matFORM','$likes')");
        $id = mysqli_insert_id($conn);
        $path = '../uploads/intrebari/'.$id;
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        
        //lucru cu imaginile
        if ($imgFORM != '') {
            $img = explode(',', $imgFORM);
            for ($i = 0; $i < count($img); $i++) {
                $currentIMG = imagecreatefromstring(base64_decode($img[$i]));
                $width = imagesx($currentIMG);
                $height = imagesy($currentIMG);
                while ($width * $height > 1308736) {  //1308736 = 1144 * 1144 (nr de pixeli pt a forma 5mb de memorie)
                    $width -= floor($width * 0.05);
                    $height -= floor($height * 0.05);
                } 
                imagescale($currentIMG, $width, $height);
                imagepng($currentIMG, "../uploads/intrebari/$id/$i.png");
            }
            
        }
        header('Location: ../index');
        
    }

    if (!isset($userAccount)) {
        echo $JSerror[0].'A aparut o eroare'.$JSerror[1];
        echo '<script>window.location = "../index.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "../baseObjects/mainHead.php"?>
        <link rel='stylesheet' href='../css/addIntrebare.css'>
        <script src="/js/addIntrebare.js" defer></script>
    </head>
    <body>
    <?php include '../baseObjects/navbar.php'?>
        <h1>Adauga o intrebare</h1>
        <div class='mainDiv'>
            <form action="addIntrebare" method="POST" enctype="multipart/form-data" class="form">
                <label><span style="color: red;">*</span> Titlu</label><br>
                <input type="text" name="titleInput" required>
                <p class="warning"></p><br><br>
                <label><span style="color: red;">*</span> Descriere</label><br>
                <div class="textareaDiv">
                    <textarea name="descInput" required></textarea>
                    <div>
                        <p>**<span style="font-weight: bold;">Bold</span>**</p>
                        <p>//<span style="font-style: italic;">Italic</span>//</p>
                        <p>##<span style="text-decoration: line-through;">Linie in mijloc</span>##</p>
                    </div>
                </div>
                <p class="warning"></p>
                <p id='textPreview'></p>
                <label>Materie</label><br>
                <select name="materii">
                    <optgroup label="B"> 
                        <option value="bio">Biologie</option>
                    </optgroup>
                    <optgroup label="C">
                        <option value="chi">Chimie</option>
                    </optgroup>
                    <optgroup label="D">
                        <option value="ses">Desen/Educatie Plastica</option>
                    </optgroup>
                    <optgroup label="E">
                        <option value="eng">Engleza</option>
                        <option value="spo">Educatie Fizica/Sport</option>
                    </optgroup>
                    <optgroup label="F">
                        <option value="fiz">Fizica</option>
                        <option value="fra">Franceza</option>
                    </optgroup>
                    <optgroup label="G">
                        <option value="geo">Geografie</option>
                        <option value="ger">Germana</option>
                    </optgroup>
                    <optgroup label="I">
                        <option value="inf">Informatica</option>
                        <option value="ist">Istorie</option>
                        <option value="ita">Italiana</option>
                    </optgroup>
                    <optgroup label="L">
                        <option value="log">Logica</option>
                    </optgroup>
                    <optgroup label="M">
                        <option value="mat">Matematica</option>
                        <option value="muz">Muzica/Educatie Muzicala</option>
                    </optgroup>
                    <optgroup label="R">
                        <option value="rel">Religie</option>
                        <option value="rom">Romana</option>
                    </optgroup>
                    <optgroup label="S">
                        <option value="spa">Spaniola</option>
                    </optgroup>
                    <optgroup label="T">
                        <option value="tic">TIC</option>
                    </optgroup>
                    <optgroup label="Altele">
                        <option value="oth" selected>Altele</option>
                    </optgroup>
                </select><br><br>
                <label>Imagini</label><br><br>
                <div id='imagesDiv'>
                    <div class="image">
                        <label for="imgInput" class="imgInput"><img src='/assests/uploadFile.png'></label>
                    </div>
                    <!-- <div class="image">
                        <img src='/assests/404.png' onclick="imgClick(this.src)">
                        <button>X</button>
                    </div> -->
                </div>
                <input id='imgInput' type='file' name='imgInput[]' multiple style="display: none;">
                <button type="button" name="Submit" id='submitButton'>Adauga</button>
            </form> 
        </div>
        <?php include '../baseObjects/imageModal/modal.php' ?>
    </body>
</html>