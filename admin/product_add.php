<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/side_bar.php'; ?>
<?php require_once '../classes/Product.php'; ?>
<?php require_once '../classes/Category.php'; ?>
<?php require_once '../classes/Brand.php'; ?>

<?php
$product = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insert_product = $product->productInsert($_POST, $_FILES);
}
?>
    <div class="col-md-9 col-sm-8">
        <div class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Добавить новый товар</strong></div>
                <div class="panel-body">
                    <?php
                    if (isset($insert_product)) {
                        echo $insert_product;
                    }
                    ?>
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Название товара</label>
                            <div class="col-sm-10">
                                <input type="text" name="product_name" class="form-control"
                                       placeholder="Введите название товара">
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
                                        while ($result = $get_cat->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $result['cat_id']; ?>"><?= $result['cat_name']; ?></option>
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
                                            <option value="<?= $result['brand_id']; ?>"><?= $result['brand_name']; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Описание</label>
                            <div class="col-sm-10">
                                <textarea name="body"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Цена товара</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control"
                                       placeholder="Введите цену товара">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Загрузить картинку</label>
                            <div class="col-sm-10">
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Тип продукта</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="type">
                                    <option>Тип продукта</option>
                                    <option value="0">Рекомендуемы</option>
                                    <option value="1">Обычные</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Сохранить">
                    </form>

                </div>
            </div>
        </div><!-- main-content -->
    </div>
<?php require_once 'inc/footer.php'; ?>