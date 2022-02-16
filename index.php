<!DOCTYPE html>
<html id="html">
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
                <div style="display: flex; justify-content: center">
                    <form action="vendor/create.php" method="post" style="display: flex; flex-direction: column; width: 400px;">
                        <span style="display: none" name="id"></span>
                        <input type="text" placeholder="Some nickname" name="username">
                        <textarea style="height: 200px; resize: none" name="comment"></textarea>
                        <button type="submit" name="publish">Опубликовать комментарий</button>
                    </form>
                </div>
                <div style="max-width: 900px; margin-top: 20px; max-height: 500px; overflow: auto; margin-bottom: 100px;" id="comment">
                    <?php
                        require_once 'config/connection.php';
                        $all_comments = mysqli_query($connect, "SELECT * FROM `comment`");
                        $all_comments = mysqli_fetch_all($all_comments);
                        foreach($all_comments as $comment){
                    ?>
                        <div style="margin-top: 20px; max-height: 500px; overflow: auto">
                            <span class="author"><?= $comment[1] . ' ' . $comment[3]?></span>
                            <article class="comm"><?= $comment[2] ?></article>
                            <div class="buttons">
                                <a href="update.php?id=<?= $comment[0] ?>"><button class="edit">Редактировать</button></a>
                                <a href="vendor/delete.php?id=<?= $comment[0] ?>"><button class="delete">Удалить</button></a>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/vue@next"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="vue/app.vue"></script>
        <!-- <script>
            $(document).ready(function(){
                console.log('script downloaded');
                $("button[name='publish']").on('click', function(){
                    let user = $("input[name='username']").val();
                    let comment = $("textarea[name='comment']").val();
                    console.log(user);
                    console.log(comment);

                    $.ajax({
                        method: "POST",
                        url: "vendor/create.php",
                        data: {username: user, comment: comment}
                    })
                    .done(function(html){
                        alert('lets go');
                        $('#comment').text(html);
                    })
                })
            })
        </script>  попытка написать что-то с использованием ajax--> 
    </body>
</html>