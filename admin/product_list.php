<?php include 'inc/header.php'; ?>
<?php include 'inc/side_bar.php'; ?>
<?php require_once '../classes/Product.php'; ?>
<?php require_once '../helpers/Format.php'; ?>

<?php
$product = new Product();
$fm = new Format();


if (isset($_GET['del_product'])) {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['del_product']);
    $del_product = $product->delProduct($id);
}
?>
    <div class="col-md-9 col-sm-8">
        <div class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Список товаров</strong></div>
                <div class="panel-body">
                    <?php
                    if (isset($del_product)) {
                        echo $del_product;
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Название</th>
                                <th>Категория</th>
                                <th>Бренд</th>
                                <th>Описание</th>
                                <th>Цена</th>
                                <th>Картинка</th>
                                <th>Тип товара</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $get_product = $product->getAllProduct();
                            if ($get_product) {
                                $i = 0;
                                while ($result = $get_product->fetch_assoc()) {
                                    $i++; ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $result['product_name']; ?></td>
                                        <td><?= $result['cat_name']; ?></td>
                                        <td><?= $result['brand_name']; ?></td>
                                        <td><?= $fm->textShorten($result['body'], 120); ?></td>
                                        <td><?= $result['price']; ?></td>
                                        <td>
                                            <div style="width: 80px; height: auto;"><img src="<?= $result['image']; ?>"
                                                                                         class="img-responsive"
                                                                                         alt="<?= $result['product_name']; ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <?php if ($result['type'] == 0) {
                                                echo 'Рекомендуемы';
                                            } else {
                                                echo 'Обычные';
                                            } ?>
                                        </td>
                                        <td><a href="product_edit.php?product_id=<?= $result['product_id']; ?>"
                                               class="btn btn-primary btn-xs" title="редактировать"><i
                                                        class="fa fa-pencil"></i></a> ||
                                            <a onclick="return confirm('Вы уверены, что хотите удалить!');"
                                               href="?del_product=<?= $result['product_id']; ?>"
                                               class="btn btn-danger btn-xs"
                                               title="удалить"><i
                                                        class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- main-content -->
    </div>
<?php include 'inc/footer.php'; ?>