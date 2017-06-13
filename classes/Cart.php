<?php
$file_path = realpath(dirname(__FILE__));
include_once($file_path . '/../lib/Database.php');
include_once($file_path . '/../helpers/Format.php');

/**
 * Cart Class
 */
class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    /**
     * Метод добавление товаров в корзину по ID
     * @param $quantity
     * @param $id
     */
    public function addToCart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $sessionId = session_id();

        $select_query = "SELECT * FROM tbl_product WHERE product_id = '$productId'";
        $result = $this->db->select($select_query)->fetch_assoc();
        $productName = $result['product_name'];
        $price = $result['price'];
        $image = $result['image'];

        $check_query = "SELECT * FROM tbl_cart WHERE product_id = '$productId' AND session_id = '$sessionId'";
        $res = $this->db->select($check_query);
        if ($res) {
            $msg = "<p class='text-danger'>Продукт уже добавлен!</p>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_cart(session_id, product_id, product_name, price, image, quantity) 
                         VALUES('$sessionId', '$productId', '$productName', '$price', '$image', '$quantity')";
            $insert_row = $this->db->insert($query);
            if ($insert_row) {
                header("Location: cart.php");
            } else {
                header("Location: 404.php");
            }
        }


    }

    /**
     * Метод выборки заказаных товаров по сессии
     */
    public function getCartProduct()
    {
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE session_id = '$sessionId'";
        $result = $this->db->select($query);
        return $result;
    }
}