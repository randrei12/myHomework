<?php
include "../php/database/connect.php";
include "../php/database/tokenHandler.php";

if (isset($_POST['requestQuestion']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = mysqli_query($conn, "SELECT * FROM intrebari WHERE id = '$id'");
    if (mysqli_num_rows($sql) === 1) {
        $intrebare = mysqli_fetch_assoc($sql);
        $email = $intrebare['user'];
        $nume = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM conturi WHERE email = '$email'"))['name'];
        echo json_encode(array_merge($intrebare, array('result' => 'success', 'nume' => $nume, 'img' => glob('../uploads/intrebari/'.$id.'/*'), 'publicToken' => md5($email))));
    } else echo json_encode(array('result' => 'error', 'message' => 'Intrebarea nu a fost gasita'));
    exit();
}

if (isset($_POST['sendLikes']) && isset($_POST['status']) && isset($_POST['user']) && isset($_POST['id'])) {
    $status = $_POST['status'];
    $user = $_POST['user'];
    $id = $_POST['id'];
    $sql = mysqli_query($conn, "SELECT likes FROM intrebari WHERE id = '$id'");
    if (mysqli_num_rows($sql) === 1) {
        $likes = json_decode(mysqli_fetch_assoc($sql)['likes']);
        if ($status == 1) {
            if (!in_array($user, $likes->likes)) array_push($likes->likes, $user);
            if (in_array($user, $likes->dislikes)) {
                $key = array_search($user, $likes->dislikes);
                unset($likes->dislikes[$key]);
                $likes->dislikes = array_values($likes->dislikes);
            }
        } else if ($status == -1) {
            if (!in_array($user, $likes->dislikes)) array_push($likes->dislikes, $user);
            if (in_array($user, $likes->likes)) {
                $key = array_search($user, $likes->likes);
                unset($likes->likes[$key]);
                $likes->likes = array_values($likes->likes);
            }
        } else {
            if (in_array($user, $likes->likes)) {
                $key = array_search($user, $likes->likes);
                unset($likes->likes[$key]);
                $likes->likes = array_values($likes->likes);
            }
            if (in_array($user, $likes->dislikes)) {
                $key = array_search($user, $likes->dislikes);
                unset($likes->dislikes[$key]);
                $likes->dislikes = array_values($likes->dislikes);
            }
        }
        $likes = json_encode($likes);
        $sql = "UPDATE intrebari SET likes = '$likes' WHERE id = '$id'";
        mysqli_query($conn, $sql);
        if (mysqli_error($conn)) echo json_encode(array('result' => 'error', 'message' => 'Eroare'));
        else echo json_encode(array('result' => 'success'));
    } else echo json_encode(array('result' => 'error', 'message' => 'Intrebarea nu a fost gasita'));
    exit();
}
    

header('HTTP/1.1 400 Bad Request');
echo '<h1>Bad Request</h1>';

?>