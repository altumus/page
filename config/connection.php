<?php

$connect = mysqli_connect('localhost','root','','comments');

if(!$connect){
    echo 'Подключение отсутствует';
}

?>