<?php

require_once '../config/connection.php';

$username = $_POST['username'];
$text = $_POST['comment'];
$date = date('G:m d.m.y');

mysqli_query($connect, "INSERT INTO `comment` (`RecordID`, `User`, `Comment`, `Date`) VALUES (NULL, '$username', '$text', '$date');");

header('Location: ../index.php')

?>