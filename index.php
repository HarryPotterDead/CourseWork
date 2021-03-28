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
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/MainPage/style.css">

    <link rel="stylesheet" href="css/MainPage/logo.css">

    <link rel="stylesheet" href="css/MainPage/menu_up.css">
    <link rel="stylesheet" href="css/MainPage/Main.css">
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
            <li><a class="a_txt" href="index.php?page=main">Главная</a></li>
            <li><a class="a_txt" href="#">Адреса Магазинов</a>
                <ul>
                    <li><a class="a_txt" href="index.php?page=Moscow">Москва</a></li>
                    <li><a class="a_txt" href="index.php?page=SantPitBurg">Санкт-Питербург</a></li>
                    <li><a class="a_txt" href="index.php?page=Ekaterinburg">Екатеринбург</a></li>
                </ul>
            </li>
            <li><a class="a_txt" href="index.php?page=Pries">Товары</a></li>
            <li><a class="a_txt" href="index.php?page=recucle">Корзина</a></li>
            <!-- <div class="Login"> -->
            <?php if (isset($_SESSION['login'])): ?>

            <li><a class="a_txt" href="index.php?page=admin"><?=$_SESSION['login']; ?></a>
            <li><a class="a_txt" href="index.php?action=logout">Выйти</a>

                <?php else: ?>

            <li><a class="a_txt" href="index.php?page=auth">Войти</a>
            <li><a class="a_txt" href="index.php?page=register">Регистрация</a>

                <?php endif ?>

        </ul>
        <!-- </div> -->
    </div>
    <div class="main_field">



        <?
        if (isset($message))print $message;
        if (isset($_REQUEST['page'])){
            require_once $_REQUEST['page'].".php";//contact.php
        }else{
            require_once "main.php";
        }
        ?>

    </div>
    <div class="footer">
        <?php require_once "footer.php" ?>
    </div>
</body>

</html>