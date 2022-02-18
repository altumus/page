<?php
    require_once '../config/connection.php';

    $username = $_POST['username'];
    $text = $_POST['comment'];
    $date = 'ред. ' . date('H:i d.m.y');
    $id = $_POST['id'];

    mysqli_query($connect, "UPDATE `comment` SET `User` = '$username', `Comment` = '$text', `Date` = '$date' WHERE `comment`.`RecordID` = '$id'");
    header('Location: ../index.php');

?>