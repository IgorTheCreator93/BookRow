<?php
session_start();
if (empty($_SESSION['reg_name'])) {$_SESSION['reg_name'] = "";
}
if (empty($_SESSION['reg_email'])) {$_SESSION['reg_email'] = "";
}
if (empty($_SESSION['log_email'])) {$_SESSION['log_email'] = "";
}
//Пользовательские функции----------------------

include "$_SERVER[DOCUMENT_ROOT]/resources/includes/functions.php";
//Фильтр
include "$_SERVER[DOCUMENT_ROOT]/resources/includes/filter.php";
//Данные формы
include "$_SERVER[DOCUMENT_ROOT]/resources/includes/form_data.php";


?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Описание</title>
    <link rel="stylesheet" href="/public/css/styles.css ">
    <link rel="stylesheet" href=" /public/css/header.css">
    <link rel="stylesheet" href="/public/css/footer.css">
    <link rel="stylesheet" href="/public/css/desc.css">
    <link rel="stylesheet" href="/public/css/modal__dialogs.css">
    <link rel="stylesheet" href="/public/css/books.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Joti+One&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Joti+One&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- Start WOWSlider.com HEAD section -->
    <link rel="stylesheet" type="text/css" href="/public/img/slider/engine1/style.css" />
    <script type="text/javascript" src="/public/img/slider/engine1/jquery.js"></script>
    <!-- End WOWSlider.com HEAD section -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <header>

        <? include "$_SERVER[DOCUMENT_ROOT]/resources/includes/header.php"; ?>
    </header>

    <section>
        <div class="desc border">
            <?
            $arr = get_db_books_id($n);
            $arr = [$arr];
            
            if ($arr <> null)
            {
                foreach ($arr as $key => $val)
                {
                    $name = $val['name'];
                    $img = $val['img'];                    
                    $author_id = $val['author'];
                    $author = get_db_authors($author_id);
                    $descr = $val['descr'];
                    $genre_id = $val['genre'];
                    $genre = get_db_genres($genre_id);
            ?>
                <div class="desc_block">
                    
                    <div class="img_genre border">
                        <img src="<? echo $img; ?>" alt="">
                        <h1>Жанр: <? echo $genre; ?></h1>
                    </div>

                    <div class="name_author_desc border">
                        <h4><? echo $name; ?></h4>
                        <h1><? echo $author; ?></h1>
                        <h2>Описание Книги:</h2>
                        <p><? echo $descr; ?></p>
                    </div>

                </div>
            <?
             }    
             }
            ?>
        </div>

    </section>

    <footer>
        <? include "$_SERVER[DOCUMENT_ROOT]/resources/includes/footer.php"; ?>
    </footer>

    <?php include "$_SERVER[DOCUMENT_ROOT]/resources/includes/modal__dialogs.php" ?>

    <script src="/public/js/scripts.js"></script>
    <!--Для предотвращения повторной отправки на кнопку «Обновить» и «Назад».-->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>


</html>