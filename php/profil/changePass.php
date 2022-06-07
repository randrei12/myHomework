<?php 
    include '../database/connect.php';
    include '../database/tokenHandler.php';
    $prefix = '../../';
    include '../../baseObjects/search.php';

    if (isset($userAccount)) {
        $email = $userAccount->email;
        $password = $userAccount->password;
    } else {
        header('Location: ../../index.php');
    }

    if(isset($_POST['submit'])) {
        if (md5($_POST['oldPassword']) == $password) {
            $newPass = md5($_POST['newPassword']);
            $changePass = "UPDATE `conturi` SET `password`='$newPass' WHERE email = '$email'";
            mysqli_query($conn, $changePass);
            unset($_COOKIE['tokenID']); 
            setcookie('cont', null, -1, '/'); 
            setcookie('cont', md5($email).$newPass, time()+3600*24*30, '/');
            header('Location: ../profile.php');
            
        } else {
            echo '<script>alert("Parola introdusa in casuta PAROLA ACTUALA nu este corecta")</script>';
        }
      
    }
?>


<!DOCTYPE html>
<html>
    <head> 
        <?php include "../../baseObjects/mainHead.php"?>

        <link href="../../css/profile/changePass.css" rel="stylesheet">
    </head>
    <body>
        <?php include '../../baseObjects/navbar.php'?>
        <div class="mainDiv">
            <form method="POST" name='form'>
                <label>Parola Actuala:</label><br>
                <input type='password' name='oldPassword' minlength="8" required><br><br>
                <label>Parola Noua:</label><br>
                <input type='password' name='newPassword' minlength="8" required><br><br><br>
                <div>
                    <input type='button' value='Inapoi' onclick="window.location = '../profile.php'">
                    <input type='submit' name='submit' id='submit' value="Salveaza">
                </div>
            </form>
        </div>
        <?php include '/xampp/htdocs/baseObjects/footer.php' ?>
    </body>
</html>