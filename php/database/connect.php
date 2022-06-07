<?php 
    $conn = mysqli_connect('localhost', 'upload', 'EH%&tF.yU5P-9Jt', 'myHomework');
    if (!$conn) {
        echo '<script>alert("Eroare la contectarea cu server-ul: ' . mysqli_connect_error().'")</script>';
    }
?>