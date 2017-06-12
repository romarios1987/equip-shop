<?php
$file_path = realpath(dirname(__FILE__));
include_once($file_path . '/../lib/Database.php');
include_once($file_path . '/../helpers/Format.php');

/**
 * Category Class
 */
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($cat_name)
    {
        $cat_name = $this->fm->validation($cat_name);
        $cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
        if (empty($cat_name)) {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Поле ввода названия категории не должно быть пустым !</p></div>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_category(cat_name) VALUES ('$cat_name')";
            $cat_insert = $this->db->insert($query);
            if ($cat_insert) {
                $msg = "<div class='bg-success'><p class='text-success text-center'>Категория успешно добавлена !</p></div>";
                return $msg;
            } else {
                $msg = "<div class='bg-danger'><p class='text-danger text-center'>Категория не добавлена !</p></div>";
                return $msg;
            }

        }
    }

    public function getAllCat()
    {
        $query = "SELECT * FROM tbl_category ORDER BY cat_id";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCatById($id)
    {
        $query = "SELECT * FROM tbl_category WHERE cat_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function catUpdate($cat_name, $id)
    {
        $cat_name = $this->fm->validation($cat_name);
        $cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($cat_name)) {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Поле ввода названия категории не должно быть пустым !</p></div>";
            return $msg;
        } else {
            $query = "UPDATE tbl_category SET cat_name = '$cat_name' WHERE cat_id = '$id'";
            $cat_update = $this->db->update($query);
            if ($cat_update) {
                $msg = "<div class='bg-success'><p class='text-success text-center'>Категория успешно обновлена !</p></div>";
                return $msg;
            } else {
                $msg = "<div class='bg-danger'><p class='text-danger text-center'>Категория не обновлена !</p></div>";
                return $msg;
            }
        }
    }

    public function delCategory($id)
    {
        $query = "DELETE FROM tbl_category WHERE cat_id = '$id'";
        $del_data = $this->db->delete($query);
        if ($del_data) {
            $msg = "<div class='bg-success'><p class='text-success text-center'>Категория успешно удалена !</p></div>";
            return $msg;
        } else {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Категория не удалена !</p></div>";
            return $msg;
        }
    }
}