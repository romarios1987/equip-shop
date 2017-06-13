<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/slider.php'; ?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Рекомендуемые товары</h3>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php
            $feature_product = $product->getFeatureProduct();
            if ($feature_product) {
                while ($result = $feature_product->fetch_assoc()) {
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?good_id=<?= $result['product_id']; ?>">
                            <img src="admin/<?= $result['image']; ?>" alt="<?= $result['product_name']; ?>">
                        </a>
                        <h2><?= $result['product_name']; ?></h2>
                        <p><?= $fm->textShorten($result['body'], 70); ?></p>
                        <p><span class="price"><?= $result['price']; ?> грн</span></p>
                        <div class="button"><span><a href="details.php?good_id=<?= $result['product_id']; ?>"
                                                     class="details">Детали</a></span></div>
                    </div>

                <?php }
            } ?>

        </div><!--/.section group-->

        <div class="content_bottom">
            <div class="heading">
                <h3>Новые товары</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $new_product = $product->getNewProduct();
            if ($new_product) {
                while ($result = $new_product->fetch_assoc()) {
                    ?>

                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?good_id=<?= $result['product_id']; ?>">
                            <img src="admin/<?= $result['image']; ?>" alt="<?= $result['product_name']; ?>">
                        </a>
                        <h2><?= $result['product_name']; ?></h2>
                        <p><span class="price"><?= $result['price']; ?> грн</span></p>
                        <div class="button">
                            <span>
                                <a href="details.php?good_id=<?= $result['product_id']; ?>" class="details">Детали</a>
                            </span>
                        </div>
                    </div>

                <?php }
            } ?>
        </div><!--/.section group-->
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>
