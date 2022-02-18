<?php

    require_once '../config/connection.php';

    $username = $_POST['username'];
    $text = $_POST['comment'];
    $date = date('H:i d.m.y');
    mysqli_query($connect, "INSERT INTO `comment` (`RecordID`, `User`, `Comment`, `Date`) VALUES (NULL, '$username', '$text', '$date');");

    $id = mysqli_query($connect, "SELECT * FROM `comment`");
    $id = mysqli_fetch_all($id);
    $id = $id[count($id)-1][0];


    echo
    "<div class='commentary-block' style='margin-top: 20px' id='$id'>
        <span class='author'>$username  $date</span>
        <article class='comm'>$text</article>
        <div class='buttons'>
            <a href='update.php?id=$id'><button class='edit'>Редактировать</button></a>
            <a href='vendor/delete.php?id=$id'><button class='delete' id='$id' name='delete'>Удалить</button></a>
        </div>
    </div>
    ";
    // header('Location: ../index.php')

?>