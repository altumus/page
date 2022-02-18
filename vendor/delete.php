<?php

    require_once '../config/connection.php';

    $id = $_POST['delete'];

    mysqli_query($connect, "DELETE FROM `comment` WHERE `comment`.`RecordID` = '$id'");
    // header('Location: ../index.php');
?>