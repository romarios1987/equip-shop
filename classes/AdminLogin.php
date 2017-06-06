<?php
require_once '../lib/Session.php';
Session::checkLogin();
require_once '../lib/Database.php';
require_once '../helpers/Format.php';

/**
 * AdminLogin Class
 */
class AdminLogin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login($adminUser, $adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass)) {
            $login_msg = "Имя пользователя или пароль не должны быть пустыми !";
            return $login_msg;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE admin_username = '$adminUser' AND admin_pass = '$adminPass'";
            $result = $this->db->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set("adminLogin", true);
                Session::set("adminId", $value['admin_id']);
                Session::set("adminUser", $value['admin_username']);
                Session::set("adminName", $value['admin_name']);
                header("Location: index.php");
            } else {
                $login_msg = "Неверно введен логин или пароль !";
                return $login_msg;
            }
        }
    }
}