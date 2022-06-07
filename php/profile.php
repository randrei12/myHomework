<?php 
    $targetID = $_GET['target'];
    include 'database/connect.php';
    include 'database/tokenHandler.php';
    $prefix = '../';
    include '../baseObjects/search.php';
    include '../baseObjects/scripts/scripts.php';
    include '../baseObjects/scripts/transformators.php';

    $persAcc = false;
    if ($targetID == md5($userAccount->tokenID)) {
        $persAcc = true;
    }

    $sql = 'SELECT * FROM `conturi`';
    $result = mysqli_query($conn, $sql);
    $conturi = mysqli_fetch_all($result);
    $targetName;
    $targetDate;
    $targetImg = 'default.png';
    $targetDesc;
    for ($i = 0; $i < count($conturi); $i++) {
        $cont = convert_obj($conturi[$i], $dbConfig->conturi);
        if (md5($cont->email) == $targetID) {
           $targetName = $cont->name;
           $targetImg = $cont->image;
           $targetDesc = $cont->desc;
           $day = date('j',strtotime($cont->time));
           $month = monthToRo(date('F',strtotime($cont->time)));
           $year = date('Y',strtotime($cont->time));
           $targetDate = $day.' '.$month.' '.$year;
        }
    }
    if (!isset($targetName)) {
        echo '<script>alert("A aparut o eroare");window.location = "/index.php"</script>';
    }
    if(isset($_GET['action'])) {
        switch($_GET['action']) {
            case 'logout':
                $_SESSION['cont'] = '';
                unset($_COOKIE['tokenID']); 
                setcookie('tokenID', null, -1, '/'); 
                $_SESSION['email'] = '';
                header('Location: ../index.php');
                break;
            case 'changePass':
                header('Location: profil/changePass.php');
                break;
            case 'edit':
                header('Location: profil/edit.php');
                break;
        }
    }

    function numar_intrebari($conn, $user) {
        return mysqli_num_rows(mysqli_query($conn, "SELECT id FROM intrebari WHERE user = '$user'"));
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <?php include "../baseObjects/mainHead.php"?>
        <script src="/js/profile.js" defer></script>
        <link rel="stylesheet" href="/css/profile.css">
    </head>
    <body>
        <?php include '../baseObjects/navbar.php'?>
        <div class="mainDiv">
            <div class='leftDiv'>
                <div class="Info">
                    <img src='../uploads/conturi/<?php echo $targetImg ?>'>
                    <div>
                        <h1><?php echo $targetName?></h1> 
                        <h3>100</h3>
                    </div>
                </div>
                <div class="ActInfo">
                    <div>
                        <div>
                            <h2>Intrebari</h2>
                            <h2><?php echo numar_intrebari($conn, $userAccount->email); ?></h2>
                        </div>
                        <div>
                            <h2>Raspunsuri</h2>
                            <h2>0</h2>
                        </div>
                        <div>
                            <h2>Like-uri</h2>
                            <h2>0</h2>
                        </div>
                    </div>
                </div>
                <div class='aboutInfo'>
                    <h2>Despre</h2>
                    <p><?php echo $targetDesc?></p>
                    <p>Creat in data de: <span style="font-weight: bold;"><?php echo $targetDate?></span></p>
                </div>
                <div class='actionCenter'>
                    <button id='edit' <?php if(!$persAcc) echo 'style="display:none"'?> onclick="edit()">Editeaza</button>
                    <button id='edit' <?php if(!$persAcc) echo 'style="display:none"'?> onclick="changePass()">Schimba-ti parola</button>
                    <button id='edit' <?php if(!$persAcc) echo 'style="display:none"'?> onclick="logout()">Deconecteaza-te</button>
                </div>
            </div>
            <div class="rightDiv">
                <div>
                    <button class="active" name="intRasp">Intrebari</button>
                    <button name="intRasp">Raspunsuri</button>
                </div>
                <div class="div2">
                    <button>A</button>
                    <?php 
                        if(isset($_POST['dat'])) {
                            echo $_POST['dat'];
                        } else {
                            echo 'nimic';
                        }
                    ?>
                </div>
            </div>
        </div>
        <script>
            function logout() {
                window.location = 'profile.php?action=logout';
            }
            function changePass() {
                window.location = 'profile.php?action=changePass';
            }
            function edit() {
                window.location = 'profile.php?action=edit';
            }
        </script>
        <?php include '/xampp/htdocs/baseObjects/footer.php' ?>
    </body>
</html>