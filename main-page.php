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
                    <!-- <form action="vendor/create.php" method="post" style="display: flex; flex-direction: column; width: 400px;">
                        <span style="display: none" name="id"></span>
                        <input type="text" placeholder="Some nickname" name="username">
                        <textarea style="height: 200px; resize: none" name="comment"></textarea>
                        <button type="submit" name="publish">Опубликовать комментарий</button>
                    </form> -->
                    <form id="captch_form" method="post" style="display: flex; flex-direction: column; width: 400px;">
                        <input type="text" placeholder="Some nickname" name="username" id="username">
                        <textarea style="height: 200px; resize: none" name="comment" id="comment"></textarea>
                        <input placeholder="captcha" type="text" name="captcha_code" id="captcha_code">
                        <img src="image.php" id="captcha_image">
                        <button type="submit" name="publish" id="publish">Опубликовать комментарий</button>
                    </form>
                </div>
                <div style="max-width: 900px; margin-top: 20px; max-height: 500px; overflow: auto; margin-bottom: 100px;" id="comments">
                    <?php
                        require_once 'config/connection.php';
                        $all_comments = mysqli_query($connect, "SELECT * FROM `comment`");
                        $all_comments = mysqli_fetch_all($all_comments);
                        foreach($all_comments as $comment){
                    ?>
                        <div class="commentary-block" style="margin-top: 20px;" id="<?= $comment[0] ?>">
                            <input type="text" value="<?= $comment[0] ?>">
                            <span class="author"><?= $comment[1] . ' ' . $comment[3]?></span>
                            <article class="comm"><?= $comment[2] ?></article>
                            <div class="buttons">
                                <a href="update.php?id=<?= $comment[0] ?>"><button class="edit">Редактировать</button></a>
                                <button class="delete" id="<?= $comment[0] ?>" name="delete">Удалить</button>
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

        <script>
            $(document).ready(function(){
                $('#captch_form').on('submit', function(event){
                    event.preventDefault();
                    if($('#captcha_code').val() == ''){
                        alert('Enter Captcha Code');
                        $('#publish').attr('disabled', 'disabled');
                        return false;
                    }
                    else{
                        alert('Form has been validate');
                        let user = $("#username").val();
                        let comment = $("#comment").val();
                        let id = $("#id")
                        console.log(user);
                        console.log(comment);
                        $.ajax({
                            url: 'vendor/create.php',
                            method: 'POST',
                            data: {username: user, comment: comment},
                            success:function(data){
                                $('#comments').append(data);
                            }
                        })
                        $('#captch_form')[0].reset();
                        $('#captcha_image').attr('src', 'image.php');
                    }
                });

                $('.delete').on('click', function(event){
                    let id = event.target.id;
                    console.log($('#' + id));
                    $.ajax({
                        url: 'vendor/delete.php',
                        method: 'POST',
                        data: {id: id},
                        success: function(){
                            $('#' + id).remove();
                        }
                    })
                });

                $('#captcha_code').on('blur', function(){
                    let code = $('#captcha_code').val();
                    console.log(code);
                    if (code == ''){
                        alert('Enter captcha code block 2');
                        $('#publish').attr('disabled', 'disabled');
                    }
                    else{
                        $.ajax({
                            url: 'check_code.php',
                            method: 'POST',
                            data: {code: code},
                            success: function(data){
                                if(data == 'success'){
                                    // alert('button enabled');
                                    $('#publish').attr('disabled', false);
                                }
                                else{
                                    $('#publish').attr('disabled', 'disabled');
                                    alert('Invalid code');
                                }
                            }
                        })
                    }
                });
            });
        </script>
    </body>
</html>