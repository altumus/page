<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Комментарии к фотографии</title>
        <link href="styles.css" rel="stylesheet">
    </head>
    <body id="app">
        <div class="container">
            <div>
                <div>
                    <img src="images/sunset-pc.jpg">
                </div>
                <form action="vendor/create.php" method="post" style="display: flex; flex-direction: column; max-width: 300px">
                    <span style="display: none" name="id"></span>
                    <input type="text" placeholder="Some nickname" name="username">
                    <textarea style="height: 200px; resize: none" name="comment"></textarea>
                    <button type="submit">Опубликовать комментарий</button>
                </form>
                <div style="max-width: 900px; margin-top: 20px">
                    <?php
                        require_once 'config/connection.php';
                        $all_comments = mysqli_query($connect, "SELECT * FROM `comment`");
                        $all_comments = mysqli_fetch_all($all_comments);
                        foreach($all_comments as $comment){
                    ?>
                        <div style="margin-top: 20px; max-height: 500px; overflow: auto">
                            <span class="author"><?= $comment[1] . ' ' . $comment[3]?></span>
                            <article class="comm"><?= $comment[2] ?></article>
                            <a href="update.php?id=<?= $comment[0] ?>"><button>Редактировать</button></a>
                            <a href="vendor/delete.php?id=<?= $comment[0] ?>"><button>Удалить</button></a>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/vue@next"></script>
        <script src="vue/app.vue"></script>
    </body>
</html>