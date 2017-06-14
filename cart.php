<?php require_once 'inc/header.php'; ?>

<?php
// Удаление товара с корзины
if (isset($_GET['del_product'])) {
    $delete_id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['del_product']);
    $delete_product = $cart->deleteProductByCart($delete_id);
}
?>


<?php

// Если методом POST - ок, вызов updateCartQuantity
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];
    $update_cart = $cart->updateCartQuantity($cart_id, $quantity);
    if ($quantity <= 0) {
        $delete_product = $cart->deleteProductByCart($cart_id);
    }
}
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Ваша корзина</h2>
                <?php if (isset($update_cart)) echo $update_cart; ?>
                <?php if (isset($delete_product)) echo $delete_product; ?>
                <table class="tblone">
                    <tr>
                        <th width="5%">№</th>
                        <th width="20%">Название товара</th>
                        <th width="10%">Картинка</th>
                        <th width="15%">Цена</th>
                        <th width="20%">Количество</th>
                        <th width="20%">Общая стоимость</th>
                        <th width="10%">Действия</th>
                    </tr>
                    <?php
                    // Вывод заказаных товаров на страницу корзины
                    $get_products = $cart->getCartProduct();
                    if ($get_products) {
                        $i = 0;
                        $sum = 0;
                        $quant = 0;
                        while ($result = $get_products->fetch_assoc()) {
                            $i++; ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $result['product_name']; ?></td>
                                <td><img src="admin/<?= $result['image']; ?>" alt="<?= $result['product_name']; ?>">
                                </td>
                                <td><?= $result['price']; ?></td>
                                <td>

                                    <form action="" method="post">
                                        <input type="hidden" name="cart_id" value="<?= $result['cart_id']; ?>">
                                        <input type="number" min="0" name="quantity"
                                               value="<?= $result['quantity']; ?>">
                                        <input type="submit" name="submit" value="Обновить">
                                    </form>

                                </td>
                                <td><?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $total; ?></td>
                                <td><a onclick="return confirm('Вы уверены, что хотите удалить!');"
                                       href="?del_product=<?= $result['cart_id']; ?>">X</a></td>
                            </tr>
                            <?php
                            $quant = $quant + $result['quantity'];
                            $sum = $sum + $total;
                            Session::set("quant", $quant);
                            Session::set("sum", $sum);
                            ?>
                        <?php }
                    } ?>

                </table>
                <?php
                $get_data = $cart->checkCartTable();
                if ($get_data) {
                    ?>
                    <table style="float:right;text-align:left;" width="40%">
                        <tr>
                            <th>Промежуточный итог:</th>
                            <td><?= $sum;; ?> грн</td>
                        </tr>
                        <tr>
                            <th>Процентная ставка:</th>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <th>Общая сумма:</th>
                            <td>
                                <?php
                                $vat = $sum * 0.1;
                                $grand_total = $sum + $vat;
                                echo $grand_total;
                                ?>

                            </td>
                        </tr>
                    </table>
                <?php }else{echo "Ваша корзина пуста!";}  ?>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt=""/></a>
                </div>
                <div class="shopright">
                    <a href="login.php"> <img src="images/check.png" alt=""/></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>

