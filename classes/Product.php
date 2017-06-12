<?php
$file_path = realpath(dirname(__FILE__));
include_once($file_path . '/../lib/Database.php');
include_once($file_path . '/../helpers/Format.php');

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
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Размер изображения должен быть меньше 1MB!</p></div>";
            return $msg;
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

    // Виборка продуктов, объединение таблиц
    public function getAllProduct()
    {
        // Первый вариант
        /*        $query = "SELECT p.*, c.cat_name, b.brand_name
                          FROM tbl_product as p, tbl_category as c, tbl_brand as b
                          WHERE p.cat_id = c.cat_id AND p.brand_id = b.brand_id
                          ORDER BY p.product_id DESC";*/

        // Второй вариант
        $query = "SELECT tbl_product.*, tbl_category.cat_name, tbl_brand.brand_name
                  FROM tbl_product 
                  INNER JOIN tbl_category ON tbl_product.cat_id = tbl_category.cat_id 
                  INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id 
                  ORDER BY product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    // Выборка товара по ID
    public function getProductById($id)
    {
        $query = "SELECT * FROM tbl_product WHERE product_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    // Обновление товара
    public function productUpdate($data, $file, $id)
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

        if ($product_name == '' || $cat_id == '' || $brand_id == '' || $desc == '' || $price == '' || $product_type == '') {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Поля не должны быть пустыми !</p></div>";
            return $msg;
        } else {
            if (!empty($file_name)) { // Если есть картинка
                if ($file_size > 1048567) {
                    $msg = "<div class='bg-danger'><p class='text-danger text-center'>Размер изображения должен быть меньше 1MB!</p></div>";
                    return $msg;
                } elseif (in_array($file_ext, $permited) === false) {
                    $msg = "<div class='bg-danger'><p class='text-danger text-center'>Вы можете загружать только:" . implode(', ', $permited) . "</p></div>";
                    return $msg;
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product 
                              SET 
                              product_name = '$product_name',
                              cat_id = '$cat_id',
                              brand_id = '$brand_id',
                              body = '$desc',
                              price = '$price',
                              type = '$product_type',
                              image = '$uploaded_image'
                              WHERE product_id = '$id'";
                    $product_update = $this->db->update($query);
                    if ($product_update) {
                        $msg = "<div class='bg-success'><p class='text-success text-center'>Товар успешно обновлен!</p></div>";
                        return $msg;
                    } else {
                        $msg = "<div class='bg-danger'><p class='text-danger text-center'>Товар не обновлен!</p></div>";
                        return $msg;
                    }
                }
            } //if (!empty($file_name))
            else {
                $query = "UPDATE tbl_product 
                              SET 
                              product_name = '$product_name',
                              cat_id = '$cat_id',
                              brand_id = '$brand_id',
                              body = '$desc',
                              price = '$price',
                              type = '$product_type'
                              WHERE product_id = '$id'";
                $product_update = $this->db->update($query);
                if ($product_update) {
                    $msg = "<div class='bg-success'><p class='text-success text-center'>Товар успешно обновлен!</p></div>";
                    return $msg;
                } else {
                    $msg = "<div class='bg-danger'><p class='text-danger text-center'>Товар не обновлен!</p></div>";
                    return $msg;
                }
            }
        }
    }


    // Удалиние товара
    public function delProduct($id)
    {
        $query = "SELECT * FROM tbl_product WHERE product_id = '$id'";
        $get_data = $this->db->select($query);
        if ($get_data) {
            while ($delete_image = $get_data->fetch_assoc()) {
                $del_link = $delete_image['image'];
                unlink($del_link);
            }
        }

        $del_query = "DELETE FROM tbl_product WHERE product_id = '$id'";
        $del_data = $this->db->delete($del_query);
        if ($del_data) {
            $msg = "<div class='bg-success'><p class='text-success text-center'>Товар успешно удален !</p></div>";
            return $msg;
        } else {
            $msg = "<div class='bg-danger'><p class='text-danger text-center'>Товар не удален !</p></div>";
            return $msg;
        }
    }

    // Выборка рекомендованих товаров (Featured Products)
    public function getFeatureProduct()
    {
        $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY product_id DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }


}