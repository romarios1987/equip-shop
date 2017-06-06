<?php
require_once '../lib/Database.php';
require_once '../helpers/Format.php';

/**
 * Brand Class
 */
class Brand
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brand_name)
    {
        $brand_name = $this->fm->validation($brand_name);
        $brand_name = mysqli_real_escape_string($this->db->link, $brand_name);
        if (empty($brand_name)) {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Поле ввода названия бренда не должно быть пустым !</p></div>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_brand(brand_name) VALUES ('$brand_name')";
            $brand_insert = $this->db->insert($query);
            if ($brand_insert) {
                $msg = "<div class='bg-success'><p class='text-success text-center'>Бренд успешно добавлен !</p></div>";
                return $msg;
            } else {
                $msg = "<div class='bg-danger'><p class='text-danger text-center'>Бренд не добавлен !</p></div>";
                return $msg;
            }
        }
    }

    public function getAllBrand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brand_id";
        $result = $this->db->select($query);
        return $result;
    }


    public function getBrandById($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brand_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }


    public function brandUpdate($brand_name, $id)
    {
        $brand_name = $this->fm->validation($brand_name);
        $brand_name = mysqli_real_escape_string($this->db->link, $brand_name);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($brand_name)) {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Поле ввода названия бренда не должно быть пустым !</p></div>";
            return $msg;
        } else {
            $query = "UPDATE tbl_brand SET brand_name = '$brand_name' WHERE brand_id = '$id'";
            $brand_update = $this->db->update($query);
            if ($brand_update) {
                $msg = "<div class='bg-success'><p class='text-success text-center'>Бренд успешно обновлен !</p></div>";
                return $msg;
            } else {
                $msg = "<div class='bg-danger'><p class='text-danger text-center'>Бренд не обновлен !</p></div>";
                return $msg;
            }
        }
    }

    public function delBrand($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brand_id = '$id'";
        $del_data = $this->db->delete($query);
        if ($del_data) {
            $msg = "<div class='bg-success'><p class='text-success text-center'>Бренд успешно удален !</p></div>";
            return $msg;
        } else {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Бренд не удален !</p></div>";
            return $msg;
        }
    }

}