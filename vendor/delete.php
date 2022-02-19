<?php

    require_once '../config/connection.php';

    $id = $_POST['id'];
    mysqli_query($connect, "DELETE FROM `comment` WHERE `comment`.`RecordID` = '$id'");
    // header('Location: ../index.php');
    $all_comments = mysqli_query($connect, "SELECT * FROM `comment`");
    $all_comments = mysqli_fetch_all($all_comments);
    if (count($all_comments) == 0){
        echo
            "
            <h3 class='empty'>There is no comments yet !</h3>
            ";
    }
?>