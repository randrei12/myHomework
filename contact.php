<?php 
    include 'php/database/connect.php';
    include 'php/database/tokenHandler.php';
    include 'baseObjects/scripts/scripts.php';
    include 'baseObjects/search.php';

    if (isset($_POST['submit'])) {
        $titlu = $_POST['titlu'];
        $categorie = $_POST['categorie'];
        $descriere = $_POST['descriere'];
        $email;
        if (isset($userAccount)) {
            $email = $userAccount->email;
        } else {
            $email = "ANONIM";
        }
        $sql = "INSERT INTO `contact`(`email`, `titlu`, `categorie`, `descriere`) VALUES ('$email','$titlu','$categorie','$descriere')";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <?php include '/xampp/htdocs/baseObjects/mainHead.php' ?>
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <?php include '/xampp/htdocs/baseObjects/navbar.php' ?>
    <div class="mainDiv">
        <form method="POST">
            <label>Titlu</label><br>
            <input type='text' name="titlu" required><br><br>
            <label>Selectati categoria</label><br>
            <select name="categorie" required>
                <option>Raportare Probleme (bug-uri, erori, etc.)</option>
                <option>Feature Request (un nou feature, recomandari, etc)</option>
                <option>Contact pentru conturi (cont pierdut sau imposibil de accesat)</option>
                <option>Altele</option>
            </select><br><br>
            <label>Descriere</label><br>
            <textarea placeholder="" rows="10" name="descriere" required></textarea><br><br>
            <input type='submit' value="Trimite" name="submit">
        </form>
    </div>
</body>
</html>