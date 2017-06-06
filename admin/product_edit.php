<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/side_bar.php'; ?>
<?php require_once '../classes/Product.php'; ?>
<?php require_once '../classes/Category.php'; ?>
<?php require_once '../classes/Brand.php'; ?>

<?php
if (!isset($_GET['product_id']) && $_GET['product_id'] == null) {
    echo "<script>window.location ='product_list.php'; </script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['product_id']);
}


$product = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $update_product = $product->productUpdate($_POST, $_FILES, $id);
}
?>
    <div class="col-md-9 col-sm-8">
        <div class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Редактировать товар</strong></div>
                <div class="panel-body">
                    <?php
                    if (isset($update_product)) {
                        echo $update_product;
                    }
                    ?>

                    <?php
                    $get_prod = $product->getProductById($id);
                    if ($get_prod) {
                        while ($value = $get_prod->fetch_assoc()) {
                            ?>
                            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Название товара</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product_name" class="form-control"
                                               value="<?= $value['product_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Категория</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="cat_id">
                                            <option>Выбрать категорию</option>
                                            <?php
                                            $category = new Category();
                                            $get_cat = $category->getAllCat();
                                            if ($get_cat) {
                                                while ($result = $get_cat->fetch_assoc()) { ?>
                                                    <option
                                                        <?php if ($value['cat_id'] == $result['cat_id']) { ?>
                                                            selected='selected'
                                                        <?php } ?>
                                                            value="<?= $result['cat_id']; ?>"><?= $result['cat_name']; ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Бренд</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="brand_id">
                                            <option>Выбрать бренд</option>
                                            <?php
                                            $brand = new Brand();
                                            $get_brand = $brand->getAllBrand();
                                            if ($get_brand) {
                                                while ($result = $get_brand->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        <?php if ($value['brand_id'] == $result['brand_id']) { ?>
                                                            selected='selected'
                                                        <?php } ?>
                                                            value="<?= $result['brand_id']; ?>"><?= $result['brand_name']; ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Описание</label>
                                    <div class="col-sm-10">
                                        <textarea name="body">
                                            <?= $value['body']; ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Цена товара</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="price" class="form-control"
                                               value="<?= $value['price']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Загрузить картинку</label>
                                    <div class="col-sm-10">
                                        <div class="img-wrap" style="margin-bottom: 10px; width: 200px; height: auto ">
                                            <img class="img-responsive" src="<?= $value['image']; ?>" height="120px"
                                                 alt="<?= $value['product_name']; ?>"></div>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Тип продукта</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="type">
                                            <option>Тип продукта</option>
                                            <?php if ($value['type'] == 0) { ?>
                                                <option selected="selected" value="0">Рекомендуемы</option>
                                                <option value="1">Обычные</option>
                                            <?php } else { ?>
                                                <option value="0">Рекомендуемы</option>
                                                <option selected="selected" value="1">Обычные</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-success pull-right" value="Обновить">
                            </form>
                        <?php }
                    } ?>
                </div>
            </div>
        </div><!-- main-content -->
    </div>
<?php require_once 'inc/footer.php'; ?>