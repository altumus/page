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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Comment edit</title>

        <link href="css/update-style.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1>Comment edit</h1>
            <form action="vendor/update.php" method="post" class="form">
                <input type="hidden" name="id" value=<?= $comment['RecordID'] ?>>
                <input type="text" id="username" placeholder="Some nickname" name="username" value=<?= $comment['User'] ?>>
                <textarea style="height: 200px; resize: none" name="comment" id="comment"><?= $comment['Comment'] ?></textarea>
                <button type="submit">Publish edited comment</button>
            </form>
        </div>
    </body>
</html>