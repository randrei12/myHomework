<?php 
    include 'database/connect.php';
    include 'database/tokenHandler.php';
    include '../baseObjects/search.php';
    include '../baseObjects/scripts/scripts.php';
    if (isset($userAccount)) {
        header('Location: profile.php?target='.md5($userAccount->email));
    }

    if (isset($_POST['login'])) {
        $userAccount = json_decode($_POST['login']);
        $email = htmlspecialchars($userAccount->email);
        $pass = md5($userAccount->password);

        $mysql = mysqli_prepare($conn, "SELECT tokenID FROM conturi WHERE email = ? AND password = ?");
        $mysql->bind_param('ss', $email, $pass);
        $mysql->execute();
        $result = $mysql->get_result()->fetch_assoc();
        if ($result != '') {
            $tokenID = $result['tokenID'];
            setcookie("cont", md5($email).md5($pass), time()+3600*24*30, '/');
            setcookie("tokenID", $tokenID, time()+3600*24*30, '/');
            $_SESSION['email'] = $email;
            echo json_encode([
                'status' => 'success',
                'message' => 'Conectare cu succes!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email-ul sau parola sunt gresite!'
            ]);
        }
        exit();
    }
    if (isset($_POST['Register'])) {
        $name = $_POST['nume'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $pass2 = $_POST['rpassword'];
       
        if ($pass == $pass2) {
            if (preg_match('/[0-9]/', $pass)) {
                $sqlSelEmail = "SELECT `email` FROM `conturi` WHERE `email` = '$email'";
                $sqlSelEmailR = mysqli_query($conn, $sqlSelEmail);
                if (mysqli_num_rows($sqlSelEmailR) == 0) {
                    $cryptPass = md5($pass);
                    $randomToken = randomString(20);
                    $sql = "INSERT INTO `conturi`(`email`, `name`, `password`, `image`, `tokenID`) VALUES ('$email', '$name', '$cryptPass', 'default.png', '$randomToken')";
                    mysqli_query($conn, $sql);
                } else {
                    echo '<script>alert("Email-ul este folosit")</script>';
                }
            } else {
                echo '<script>alert("Parola trebuie sa contina cel putin un numar")</script>';
            }
        } else {
            echo '<script>alert("Parolele nu se potrivesc")</script>';
        }
    }
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
    <head>
        <?php include "../baseObjects/mainHead.php"?>
        <script src="/js/cont.js" defer></script>
        <link href="../css/cont.css" rel="stylesheet">
    </head>
    <body style='background-color: #7cc29a;' >
        <?php include '../baseObjects/navbar.php'?>
        <div class='mainDiv'>

            <div class='loginDiv'>
                <h1>Conectare</h1>
                <input type='email' placeholder='Email'>
                <input type='password' placeholder='Parola'>
                <p class='ValidatorPar' style='display: none'></p>
                <button class='submit'>Conecteaza-te</button>
                <div class='loginDivBottom'>
                    <a onclick='register()'>Inregistreaza-te</a>
                    <a href="account/resetPassword.php">Am uitat parola</a>
                </div>
            </div>

            <div class='registerDiv' style='display:none'>
                <h1>Creeaza Cont</h1>
                <input type='text' placeholder='Nume'>
                <input type='email' placeholder='Email'>
                <input type='password' placeholder='Parola'>
                <input type='password' placeholder='Repeta Parola'>
                <p class='ValidatorPar' style='display: none'></p>
                <button class='submit'>Creeaza Cont</button>
                <div class='loginDivBottom'>
                    <a onclick='login()'>Inregistreaza-te</a>
                </div>
            </div>

            <!-- <form class='loginDiv' name='login' action='' method='POST'>
                <label><span style="color: red;">*</span> Email</label><br>
                <input type="email" name='Email' required><br> 
                <label><span style="color: red;">*</span> Parola</label><br>
                <input type="password" name='Pass' minlength="8" required><br><br>
                <button class='submit' name='Login'>Conecteaza-te</button><br>
                <div class='loginDivBottom'>
                    <a onclick="register()">Inregistreaza-te</a>
                    <a href='account/resetPassword.php'>Am uitat parola</a>
                </div>
            </form> -->
            <!-- <form class='registerDiv' name='register' style="display: none;" action='' method='POST'>
                <label><span style="color: red;">*</span> Nume</label><br>
                <input type="text" autocomplete="off" name='nume' required><br>
                <label><span style="color: red;">*</span> Email</label><br>
                <input type="email" autocomplete="off" name='email' required><br>
                <label><span style="color: red;">*</span> Parola</label><br>
                <input type="password" autocomplete="new-password" name='password' minlength="8" required><br>
                <label><span style="color: red;">*</span> Repeta parola</label><br>
                <input type="password" autocomplete="new-password" name='rpassword' minlength="8" required><br><br>
                <button class='submit' name='Register'>Creeaza cont</button><br>
                <div class='loginDivBottom'>
                    <a onclick="login()">Conectare</a>
                </div>
            </form> -->
        </div>
        <?php include '/xampp/htdocs/baseObjects/footer.php' ?>
    </body>
</html>