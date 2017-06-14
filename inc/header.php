<?php
$file_path = realpath(dirname(__FILE__));
include_once($file_path . '/../lib/Session.php');
Session::init();

include_once($file_path . '/../lib/Database.php');
include_once($file_path . '/../helpers/Format.php');

//spl_autoload_register — Регистрирует заданную функцию в качестве реализации метода __autoload()
spl_autoload_register(function ($class) {
    include_once "classes/" . $class . ".php";
});

$db = new Database();
$fm = new Format();
$product = new Product();
$cart = new Cart();


header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
ob_start();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Store Website</title>
    <!--styles css-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/flexslider.css">
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">

    <!-- js files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/script.js"></script>

    <!--<script type="text/javascript" src="js/nav.js"></script>-->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <!--<script type="text/javascript" src="js/nav-hover.js"></script>-->
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
</head>

<body>

<div class="wrap">
    <div class="header_top">
        <div class="logo">
            <a href="/"><img src="images/logo.png" alt=""/></a>
        </div>
        <div class="header_top_right">
            <div class="search_box">
                <form>
                    <input type="text" value="Search for Products" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit"
                                                                                                       value="SEARCH">
                </form>
            </div>
            <div class="shopping_cart">
                <div class="cart">
                    <a href="cart.php" title="View my shopping cart" rel="nofollow">
                        <span class="cart_title">Корзина</span>
                        <span class="no_product">
                            <?php
                            $get_data = $cart->checkCartTable();
                            if ($get_data) {
                                $sum = Session::get("sum");
                                $quant = Session::get("quant");
                                echo $sum . ' грн' . ' (' . $quant . ')';
                            } else {
                                echo "(Empty)";
                            }
                            ?>

                        </span>
                    </a>
                </div>
            </div>
            <div class="login"><a href="login.php">Login</a></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="menu">
        <ul id="dc_mega-menu-orange" class="dc_mm-orange">
            <li><a href="index.php">Главная</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="top_brands.php">Top Brands</a></li>
            <li><a href="cart.php">Корзина</a></li>
            <li><a href="contact.php">Contact</a></li>
            <div class="clear"></div>
        </ul>
    </div>