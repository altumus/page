<?php
    require_once 'config/connection.php';
    $comment_id = $_GET['id'];
    $comment = mysqli_query($connect, "SELECT * FROM `comment` WHERE `RecordID` = '$comment_id' ");
    $comment = mysqli_fetch_assoc($comment);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Страница редактирования комментария</title>
    </head>
    <body>
        <form action="vendor/update.php" method="post" style="display: flex; flex-direction: column; max-width: 300px">
            <input type="hidden" name="id" value=<?= $comment['RecordID'] ?>>
            <input type="text" placeholder="Some nickname" name="username" value=<?= $comment['User'] ?>>
            <textarea style="height: 200px; resize: none" name="comment"><?= $comment['Comment'] ?></textarea>
            <button type="submit">Опубликовать измененный комментарий</button>
        </form>
    </body>
</html>