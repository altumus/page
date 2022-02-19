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
    "
    <div class='comment' id='$id'>
        <article>
            <div class='author'>
                <h3>$username</h3>
                <h5>$date</h5>
            </div>
            <p>
                $text
            </p>
        </article>
        <div class='buttons'>
            <a href='update.php?id=$id'><button class='update-btn'>Update</button></a>
            <button onclick='del(event)' class='delete-btn' id='$id' name='delete-btn'>Delete</button>
        </div>
    </div>
    "
    // header('Location: ../index.php')

?>