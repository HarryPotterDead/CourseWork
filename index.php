<?php
require_once 'connect.php';
require_once 'action.php';
?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <title>Two Cairs</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/MainPage/style.css">

    <link rel="stylesheet" href="css/MainPage/logo.css">

    <link rel="stylesheet" href="css/MainPage/menu_up.css">
    <link rel="stylesheet" href="css/MainPage/Main.css">
    <link rel="stylesheet" href="css/MainPage/Badrooms.css">
    <link rel="stylesheet" href="css/MainPage/Livingrooms.css">
    <link rel="stylesheet" href="css/MainPage/Kitchens.css">
    <link rel="stylesheet" href="css/MainPage/AboutUs.css">
    <link rel="stylesheet" href="css/MainPage/side_menu.css">

    <link rel="stylesheet" href="css/MainPage/MainField.css">
    <link rel="stylesheet" href="css/MainPage/text.css">

</head>

<body>
    <div class="logo">
        <img src="Assets/Logo/214d9e87-08a4-4a1b-981d-5f98d6e91d57_200x200.png" alt="Логотип не загрузился">
    </div>
    <div class="menu_up">
        <ul>
            <li><a href="index.php?page=main">Главная</a></li>
            <li><a href="#">Услуги</a>
                <ul>
                    <li><a href="index.php?page=order_phone">Заказ оптом</a></li>
                    <li><a href="#">Доставка</a></li>
                    <li><a href="#">Контроль качества</a></li>
                </ul>
            </li>
            <li><a href="#">Цены</a></li>
            <li><a href="index.php?page=contact">Контакты</a></li>
            <li><a href="index.php?page=auth">Авторизация</a></li>
            <li><a href="index.php?page=admin">Админка</a></li>
        </ul>
        <div class="Login">
            <a href="/Login.html">Войти</a>
        </div>

        <!-- Старое меню. Не трогать, вдруг понадобится
        <div class="Main"> <a href="index.html" class="MainButton">Главная</a> </div>
        <div class="Badrooms"> <a href="index.html" class="MainButton">Спальни</a> </div>
        <div class="Livingrooms"> <a href="index.html" class="MainButton">Гостинные</a> </div>
        <div class="Kitchens"> <a href="index.html" class="MainButton">Кухни</a> </div>
        <div class="AboutUs"> <a href="index.html" class="MainButton">О Нас</a> </div>
        -->
    </div>
<!--    <div class="side_menu">
        <p>Боковая менюшка</p>
        <p>Растягивается под , контент</p>
        <p>держу в курсе</p>
    </div> -->
    <div class="main_field">


        <?
        if (isset($_REQUEST['page'])){
            require_once $_REQUEST['page'].".php";//contact.php
        }else{
            require_once "main.php";
        }
        ?>

    </div>
</body>

</html>