<?php require_once '../lib/Session.php';
Session::checkSession();

//set headers to NOT cache a page
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// Date in the past
//or, if you DO want a file to cache, use:
header("Cache-Control: max-age=2592000");
//30days (60sec * 60min * 24hours * 30days)

ob_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="tinymce/tinymce.min.js"></script>

    <script src="js/script.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink link image lists charmap print preview table code media colorpicker paste textcolor'
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <h2 class="text-center top-header"><a href="index.php">Панель администратора</a></h2>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="navbar-brand">Ecommerce</span>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="categories.php"><i class="fa fa-user-circle" aria-hidden="true"></i> Профиль
                                пользователя</a></li>
                        <li><a href="#"><i class="fa fa-inbox"></i> Входящие</a></li>
                        <li><a href="users.php">Пользователи</a></li>
                        <li><a href="http://ecommerce-oop.loc/" target="_blank"><i class="fa fa-share"></i> Перейти на сайт</a></li>
                    </ul>
                    <?php if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                        Session::destroy();
                        header("Location: login.php");
                    }
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Привет
                                <?= Session::get("adminName"); ?> !<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-key" aria-hidden="true"></i> Изменить пароль</a></li>
                                <li><a href="?action=logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Выход</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.collapse -->
            </div>
        </nav>
        <div class="row">