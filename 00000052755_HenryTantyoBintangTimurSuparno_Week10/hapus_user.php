<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
include 'config.php';

$id = (int) $_GET['id'];

if($id) {
    $sql = "DELETE FROM user WHERE user_id='{$id}'";
    $query = mysqli_query($koneksi, $sql);
}

header('Location: tambah_user.php');
exit;
?>