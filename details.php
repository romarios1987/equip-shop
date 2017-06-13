<?php require_once 'inc/header.php'; ?>
<?php
if (!isset($_GET['good_id']) && $_GET['good_id'] == null) {
    echo "<script>window.location ='404.php'; </script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['good_id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $add_cart = $cart->addToCart($quantity, $id);
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="cont-desc span_1_of_2">
                <?php
                $get_product = $product->getSingleProduct($id);
                if ($get_product) {
                    while ($result = $get_product->fetch_assoc()) {
                        ?>
                        <div class="grid images_3_of_2">
                            <img src="admin/<?= $result['image']; ?>" alt="<?= $result['product_name']; ?>">
                        </div>
                        <div class="desc span_3_of_2">
                            <h2><?= $result['product_name']; ?></h2>
                            <!--<p><?/*= $result['body'] ;*/ ?></p>-->
                            <div class="price">
                                <p>Цена: <span><?= $result['price']; ?> грн</span></p>
                                <p>Категория: <span><?= $result['cat_name']; ?></span></p>
                                <p>Бренд:<span><?= $result['brand_name']; ?></span></p>
                            </div>

                            <div class="add-cart">
                                <form action="" method="post">
                                    <input type="number" class="buyfield" name="quantity" value="1"/>
                                    <input type="submit" class="buysubmit" name="submit" value="Купить"/>
                                </form>
                            </div>
                            <?php if (isset($add_cart)) echo $add_cart;?>
                        </div>
                        <div class="product-desc">
                            <h2>Информация о товаре</h2>
                            <p><?= $result['body']; ?></p>
                        </div>
                    <?php }
                } ?>

            </div><!--/.cont-desc-->

            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <li><a href="product_by_cat.php">Mobile Phones</a></li>
                    <li><a href="product_by_cat.php">Desktop</a></li>
                    <li><a href="product_by_cat.php">Laptop</a></li>
                    <li><a href="product_by_cat.php">Accessories</a></li>
                    <li><a href="product_by_cat.php#">Software</a></li>
                    <li><a href="product_by_cat.php">Sports & Fitness</a></li>
                    <li><a href="product_by_cat.php">Footwear</a></li>
                    <li><a href="product_by_cat.php">Jewellery</a></li>
                    <li><a href="product_by_cat.php">Clothing</a></li>
                    <li><a href="product_by_cat.php">Home Decor & Kitchen</a></li>
                    <li><a href="product_by_cat.php">Beauty & Healthcare</a></li>
                    <li><a href="product_by_cat.php">Toys, Kids & Babies</a></li>
                </ul>

            </div>
        </div>
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>

