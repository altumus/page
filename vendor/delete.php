<?php

    require_once '../config/connection.php';

    $id = $_GET['id'];

    mysqli_query($connect, "DELETE FROM `comment` WHERE `comment`.`RecordID` = '$id'");
    header('Location: ../index.php');
?>