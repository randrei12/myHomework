<?php 
    include '../database/connect.php';
    include '../database/tokenHandler.php';
    $prefix = '../../';
    include '../../baseObjects/search.php';

    //pentru a functiona ne bazam exclusiv pe tokenHandler.php
    $email = $userAccount->email;
    $desc = $userAccount->desc;
    $nume = $userAccount->name;
    $password = $userAccount->password;
    $imagine = $userAccount->image;
    $target = md5($_COOKIE['tokenID']);

    if(isset($_POST['submit'])) {
        $nume = $_POST['nume'];
        $desc = $_POST['description'];
        if ($_FILES['image']['name'] != '') {
            $JSerror = ['<script>alert("', '");</script>'];
            //$fisier = $_FILES['image']['name'];
            //$uploadfile = "../../uploads/conturi/". basename($fisier);
            if ($_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/gif' || $_FILES['image']['type'] == 'image/jpeg') {
                if ($_FILES['image']['size'][$i] > 500000) {
                    echo $JSerror[0]. 'Marimea imaginii este prea mare('.(floor($_FILES['image']['size'][$i]/1024 *100)/100).'KB)'. $JSerror[1];
                } else {
                    $convImg;
                    if ($_FILES['image']['type'] == 'image/gif') {
                        $convImg = imagecreatefromgif($_FILES['image']['tmp_name']);
                    }else if ($_FILES['image']['type'] == 'image/jpeg') {
                        $convImg = imagecreatefromjpeg($_FILES['image']['tmp_name']);
                    }else if ($_FILES['image']['type'] == 'image/png') {
                        $convImg = imagecreatefrompng($_FILES['image']['tmp_name']);
                    }
                    imagepng($convImg, '../../uploads/conturi/'.$nume.'.png');
                    $newFile = $nume.'.png';
                    $updateSQL = "UPDATE `conturi` SET `name`='$nume',`image`='$newFile',`description`='$desc' WHERE `email` = '$email'";
                }
                
            }else {
                echo $JSerror[0].'Formatul nu este acceptat (formate acceptate: .gif, .jpg, .jpeg, .jfif, .pjpeg, .pjp, .png)'.$JSerror[1];
            }
        } else {
            $updateSQL = "UPDATE `conturi` SET `name`='$nume', `description`='$desc' WHERE `email` = '$email'";
        }
        if (!$conn->query($updateSQL)) {
            echo "query failed: (" . $conn->errno . ") " . $conn->error;
        } else {
            mysqli_query($conn, $updateSQL);
        }
        header('Location: ../profile.php?target='.$target); 
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <?php include "../../baseObjects/mainHead.php"?>

        <link href="../../css/profile/edit.css" rel="stylesheet">
    </head>
    <body>
        <?php include '../../baseObjects/navbar.php'?>
        <div class="mainDiv">
            <form method="POST" enctype="multipart/form-data" name='form'>
                <label>Nume:</label><br>
                <input type='text' name='nume' value='<?php echo $nume?>'><br><br>
                <label>Descriere:</label><br>
                <textarea name='description' rows="4" cols="50"><?php echo $desc ?></textarea><br><br><br>
                <label>Imagine:</label><br>
                <label class='imageUpload' style='background-image: url(../../uploads/conturi/<?php echo $imagine?>);' for='image'><i class="fa fa-camera"></i></label><br>
                <input type='file' name='image' id='image'  style="display: none;" accept="image/png, image/gif, image/jpeg"> 
                <!-- value='<?php //echo $imagine?>' de sus, luat temporar -->
                <div>
                    <input type='button' class="btnBack" value='Inapoi' onclick="window.location = '../profile.php?target=<?php echo $target ?>'">
                    <input type='submit' name='submit' id='submit' value="Salveaza">
                </div>
            </form>
        </div> 
        <?php include '/xampp/htdocs/baseObjects/footer.php' ?>
    </body>
</html>