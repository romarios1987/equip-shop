<?php
require_once '../lib/Database.php';
require_once '../helpers/Format.php';

/**
 * Product Class
 */
class Product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    //Добавление товара
    public function productInsert($data, $file)
    {
        $product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
        $cat_id = mysqli_real_escape_string($this->db->link, $data['cat_id']);
        $brand_id = mysqli_real_escape_string($this->db->link, $data['brand_id']);
        $desc = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $product_type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($product_name == '' || $cat_id == '' || $brand_id == '' || $desc == '' || $price == '' || $product_type == '' || $file_name == '') {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Поля не должны быть пустыми !</p></div>";
            return $msg;
        } elseif ($file_size > 1048567) {
            echo "<div class='bg-danger'><p class='text-danger text-center'>Размер изображения должен быть меньше 1MB!</p></div>";
        } elseif (in_array($file_ext, $permited) === false) {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Вы можете загружать только:" . implode(', ', $permited) . "</p></div>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(product_name, cat_id, brand_id, body, price, type, image)
                          VALUES('$product_name', '$cat_id', '$brand_id', '$desc', '$price', '$product_type', '$uploaded_image')";
            $product_insert = $this->db->insert($query);
            if ($product_insert) {
                $msg = "<div class='bg-success'><p class='text-success text-center'>Товар успешно добавлен!</p></div>";
                return $msg;
            } else {
                $msg = "<div class='bg-danger'><p class='text-danger text-center'>Товар не добавлен!</p></div>";
                return $msg;
            }
        }
    }

}