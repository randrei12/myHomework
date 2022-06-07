<?php 
    session_start();
    if (isset($_COOKIE['tokenID']) && $_COOKIE['tokenID'] != "") {
        $token = $_COOKIE['tokenID'];
        $conturiSQL = "SELECT * FROM `conturi` WHERE `tokenID` = '$token'";
        $conturiRes = mysqli_query($conn, $conturiSQL) or die(mysqli_error($conn));
        if (mysqli_num_rows($conturiRes) > 0) {
            $userAccount = mysqli_fetch_object($conturiRes);
        }
    }
?>