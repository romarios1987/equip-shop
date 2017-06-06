<?php require_once '../classes/AdminLogin.php'; ?>
<?php
$admin_login = new AdminLogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_user = $_POST['admin_username'];
    $admin_password = md5($_POST['admin_pass']);

    $login_check = $admin_login->login($admin_user, $admin_password);
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Вход администратора</title>
    <link rel="stylesheet" type="text/css" href="css/style_login.css" media="screen"/>
</head>
<body>
<div class="container">
    <section id="content">
        <form action="login.php" method="post">
            <h1>Вход администратора</h1>
            <span style="color: red; font-size: 18px;">
                <?php if (isset($login_check)) {
                    echo $login_check;
                } ?>
            </span>
            <div>
                <input type="text" placeholder="Имя пользователя" name="admin_username">
            </div>
            <div>
                <input type="password" placeholder="Пароль пользователя" name="admin_pass">
            </div>
            <div>
                <input type="submit" value="Войти">
            </div>
        </form><!-- form -->
    </section><!-- content -->
</div><!-- container -->
</body>
</html>