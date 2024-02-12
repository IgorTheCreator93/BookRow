<?php
session_start();
if (empty($_SESSION['reg_name'])) {$_SESSION['reg_name'] = "";}
if (empty($_SESSION['reg_email'])) {$_SESSION['reg_email'] = "";}
if (empty($_SESSION['log_email'])) {$_SESSION['log_email'] = "";}
if (empty($_SESSION['log_stat'])) {$_SESSION['log_stat'] = "";}

// Пользовательские функции----------------------
include "./resources/includes/functions.php";
//Фильтр
include "./resources/includes/filter.php";
//Данные формы
include "./resources/includes/form_data.php";


?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookRow</title>
 
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="/public/css/ap.css">
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
        <? include "./resources/includes/header.php"; ?>   
    </header>

    <section>
        <? include "./resources/includes/slider.php"; ?>
    </section>

    <section>
        <? include "./resources/includes/catalog.php"; ?>
    </section>

    <footer>
        <? include "./resources/includes/footer.php"; ?>
    </footer>


    <script src="/public/js/scripts.js"></script>
    <? include "./resources/includes/modal__dialogs.php" ?>

    <!--Для предотвращения повторной отправки на кнопку «Обновить» и «Назад».-->
    <script>
        if (window.history.replaceState) {window.history.replaceState(null, null, window.location.href);}
    </script>
</body>


</html>