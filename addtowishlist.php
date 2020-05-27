<?php

ob_start();
session_start();
require_once 'config/connect.php';
$uid = $_SESSION['customerid'];

if (!isset($_SESSION['customer']) & empty($_SESSION['customer'])) {
    header('location: login.php');
}

if (isset($_GET['id']) & !empty($_GET['id'])) {
    $pid = $_GET['id'];
    $sql = "SELECT * FROM wishlist WHERE pid = $pid AND uid =$uid";
    $res = mysqli_query($connection, $sql);

    if (mysqli_num_rows($res) == 0) {
        $isql = "INSERT INTO wishlist (pid, uid) VALUES ($pid, $uid)";
        $ires = mysqli_query($connection, $isql);

        /* if ($ires) {
          @todo toast notification
          
          header('location: wishlist.php');
        } */
    }
}

// header('location: wishlist.php');
header("location: " . $_SERVER["HTTP_REFERER"]);
?>
