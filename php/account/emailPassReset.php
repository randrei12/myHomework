<?php 
    include '../database/connect.php';
    include '../database/tokenHandler.php';
    include '../../baseObjects/scripts/scripts.php';
    include '../../baseObjects/search.php';

    $target = '';
    if (!isset($_GET['s'])) {
        $error = 'A intervenit o eroare, va rugam sa incercati mai tarziu.';
        echo "<script>hide('$error')</script>";
    } else {
        $url = $_GET['s'];
        $sql = "SELECT * FROM `passreset` WHERE `url` = '$url'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($result) > 0) {
            $target = mysqli_fetch_all($result);
            
        } else {
            $error = 'Link-ul a expirat';
            echo "<script>hide('$error')</script>";
        }
    }

    if (isset($_POST['Send'])) {
        $pass = $_POST['npass'];
        $pass2 = $_POST['rpass'];
        if ($target != '') {
            if ($pass == $pass2) {
                if (preg_match('/[0-9]/', $pass)) {
                    $email = $target[0][0];
                    $npass = md5($pass);
                    $sql2 = "UPDATE `conturi` SET `password`='$npass' WHERE `email` = '$email'";
                    mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                    if (!mysqli_error($conn)) {
                        unset($_COOKIE['tokenID']); 
                        setcookie('cont', null, -1, '/'); 
                        setcookie('cont', md5($email).$nPass, time()+3600*24*30, '/');
                    } else {
                        echo '<script>alert("A intervenit o eroare. Va rugam sa incercati mai tarziu.")</script>';
                    }  
                    header('Location: /index.php');
                } else {
                    echo '<script>alert("Parola trebuie sa contina cel putin un numar")</script>';
                }
            } else {
                echo '<script>alert("Parolele nu se potrivesc")</script>';
            }
        } else {
            echo '<script>alert("Eroare")</script>';
        }
    }
    

?>
 
<!DOCTYPE html>
<html>
    <head>
        <?php include "../../baseObjects/mainHead.php"?>

        <link href="../../css/cont.css" rel="stylesheet">
    </head>
    <body style='background-color: #7cc29a;' >
        <?php include '../../baseObjects/navbar.php'?>
         <div class='mainDiv' id='main'>
            <form class='loginDiv' id='login' action='' method='POST'>
                <label><span style="color: red;">*</span> Parola noua</label><br>
                <input type="password" name='npass' minlength="8" required><br>
                <label><span style="color: red;">*</span> Repeta parola</label><br>
                <input type="password" name='rpass' minlength="8" required><br>
                <input type='submit' value="Trimite" name='Send'><br>
            </form>
        </div>
        <div class='bottomDiv'>
            <p style="color: white;">ASA</p>
        </div>
        <script>
            function hide(error) {
                document.getElementById('login').setAttribute('style', 'display:none');
                document.getElementById('main').innerHTML = error;
            }

        </script>
        <?php include '/xampp/htdocs/baseObjects/footer.php' ?>
    </body>
</html>