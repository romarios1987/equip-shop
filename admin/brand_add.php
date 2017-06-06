<?php include 'inc/header.php'; ?>
<?php include 'inc/side_bar.php'; ?>
<?php require_once '../classes/Brand.php'; ?>

<?php
$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = $_POST['brand_name'];
    $insert_brand = $brand->brandInsert($brand_name);
}
?>
    <div class="col-md-9 col-sm-8">
        <div class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Добавить новый бренд</strong></div>
                <div class="panel-body">
                    <?php
                    if (isset($insert_brand)) {
                        echo $insert_brand;
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-block">
                            <input type="text" class="form-control" name="brand_name"
                                   placeholder="Введите название бренда">
                            <input type="submit" name="submit" class="btn btn-success" value="Сохранить">
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- main-content -->
    </div>
<?php include 'inc/footer.php'; ?>