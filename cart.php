<?php require_once 'inc/header.php'; ?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Ваша корзина</h2>
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
                                        <input type="number" name="" value="<?= $result['quantity']; ?>">
                                        <input type="submit" name="submit" value="Обновить">
                                    </form>
                                </td>
                                <td><?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $total; ?></td>
                                <td><a href="">X</a></td>
                            </tr>
                            <?php $sum = $sum + $total; ?>
                        <?php }
                    } ?>

                </table>
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

