<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>Comments on sunset!</title>

        <!-- styles -->
        <link href="css/styles.min.css" rel="stylesheet">

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap" rel="stylesheet">
    </head>
    <body id="app">
        <span class="title">
            <h1>Page with comments</h1>
        </span>

        <!-- общий контейнер для картинки и формы ввода  -->
        <div class="main-container">

            <div class="img-container">
                <!-- блок с картинкой для пк -->
                <div class="pc-img"> 
                    <img src="images/sunset-pc.jpg">
                </div>

                <!-- блок с картинкой для телефонов -->
                <div class="mobile-img">
                    <img src="images/sunset-mb.jpg">
                </div>

            </div>

            <!-- блок с формой ввода -->
            <div class="form">
                <form class="form-container" id="captch_form" method="post" >

                    <label>Username:</label>

                    <input type="text" placeholder="Input username" name="username" id="username">

                    <label>Comment:</label>

                    <textarea placeholder="Input comment" name="comment" id="comment"></textarea>

                    <img src="vendor/image.php" id="captcha_image">

                    <!-- в аттрибуте onclick лежит функция обновления капчи  -->
                    <button onclick="refresh()">Refresh</button>

                    <!-- поле ввода капчи -->
                    <input type="text" placeholder="Input captcha" name="captcha_code" id="captcha_code">

                    <button type="submit" name="publish" id="publish">Send captcha</button>

                </form>
            </div>
        </div>

        <div class="comments-container">
            <!-- подключение к бд и получение из неё данных -->
            <?php
                require_once 'config/connection.php';
                $all_comments = mysqli_query($connect, "SELECT * FROM `comment` ORDER BY RecordID DESC");
                $all_comments = mysqli_fetch_all($all_comments);
                if (count($all_comments) == 0){
                    echo
                    "
                        <h3 class='empty'>There is no comments yet !</h3>
                    ";
                }
                foreach($all_comments as $comment){
            ?>
                <div class="comment" id="<?= $comment[0] ?>">
                    <article>
                        <div class="author">
                            <h3><?= $comment[1] ?></h3>
                            <h5><?= $comment[3] ?></h5>
                        </div>
                        <p>
                            <?= $comment[2] ?>
                        </p>
                    </article>
                    <div class="buttons">
                        <a href="update.php?id=<?= $comment[0] ?>"><button class="update-btn">Update</button></a>
                        <button onclick="del(event)" class="delete-btn" id="<?= $comment[0] ?>" name="delete-btn">Delete</button>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>

        <!-- vue -->
        <script src="https://unpkg.com/vue@next"></script>
        <script src="vue/app.vue"></script>

        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <!-- ajax scripts -->

        <script>

            function del(event){ // функция удаления комменатрия
                let id = event.target.id; // определяем id записи
                $.ajax({
                    url: 'vendor/delete.php', 
                    method: 'POST',
                    data: {id: id}, // передаём id в файл с удалением
                    success: function(data){
                        $('#' + id).remove(); // удаляем блок
                        $('.comments-container').append(data); //добавляем ответ от файла, если таковой есть
                    }
                })
            };

            function refresh(){ //функция обновления капчи
                $('#captcha_image').attr('src', 'vendor/image.php'); //переприсваиваем аттрибуту значение
            }

            $(document).ready(function(){
                $('#captch_form').on('submit', function(event){
                    event.preventDefault(); //предотваращаем перезагрузку страницы
                    if($('#captcha_code').val() == ''){ //проверяем пустоту поля ввода капчи
                        alert('Dont forget to enter captcha code!'); //выводим сообщение если оно пустое
                        $('#publish').attr('disabled', 'disabled'); //деактивируем кнопку
                        return false;
                    }
                    else{
                        alert('Form has been validate'); //если всё хорошо, то выводим сообщение о том, что форма прошла валидацию
                        let user = $("#username").val(); //узнаём какой ник ввёл пользователь
                        let comment = $("#comment").val(); //узнаём какой комментарий ввёл пользователь
                        $.ajax({
                            url: 'vendor/create.php',
                            method: 'POST',
                            data: {username: user, comment: comment}, //отправляем данные пользователя в файл с созданием
                            success:function(data){
                                $('.empty').remove(); //удаляем поле с сообщением о пустоте блока с комментариями
                                $('.comments-container').prepend(data); //добавляем запись пользователя
                            }
                        })
                        $('#captch_form')[0].reset(); //очищаем форму
                        $('#captcha_image').attr('src', 'vendor/image.php'); //обновляем капчу
                    }
                });

                $('#captcha_code').on('blur', function(){ //проверяем  капчу, когда человек заполнил одно из полей
                    let code = $('#captcha_code').val(); //получаем значение капчи
                    if (code == ''){
                        $('#publish').attr('disabled', 'disabled'); //при пустом значении деактивируем кнопку
                    }
                    else{
                        $.ajax({
                            url: 'vendor/check_code.php',
                            method: 'POST',
                            data: {code: code}, //иначе перенаправляем введенный код на проверку
                            success: function(data){
                                if(data == 'success'){
                                    $('#publish').attr('disabled', false); //если всё верно, то активируем кнопку
                                }
                                else{
                                    $('#publish').attr('disabled', 'disabled'); //иначе деактивируем кнопку
                                    alert('Invalid code'); //выводим сообщение о неверно введеной капче
                                }
                            }
                        })
                    }
                });
            });

        </script>

    </body>
</html>
