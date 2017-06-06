<?php include 'inc/header.php'; ?>
<?php include 'inc/side_bar.php'; ?>
<?php require_once '../classes/Brand.php'; ?>

<?php
if (!isset($_GET['brand_id']) && $_GET['brand_id'] == null) {
    echo "<script>window.location ='brand_list.php'; </script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brand_id']);
}
$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = $_POST['brand_name'];
    $update_brand = $brand->brandUpdate($brand_name, $id);
}
?>
    <div class="col-md-9 col-sm-8">
        <div class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Редактировать бренд продукта</strong></div>
                <div class="panel-body">
                    <?php
                    if (isset($update_brand)) {
                        echo $update_brand;
                    }
                    ?>
                    <?php
                    $get_brand = $brand->getBrandById($id);
                    if ($get_brand) {
                        while ($result = $get_brand->fetch_assoc()) {
                            ?>
                            <form action="" method="post">
                                <div class="form-block">
                                    <input type="text" class="form-control" name="brand_name"
                                           value="<?= $result['brand_name']; ?>">
                                    <input type="submit" name="submit" class="btn btn-success" value="Обновить">
                                </div>
                            </form>
                        <?php }
                    } ?>
                </div>
            </div>
        </div><!-- main-content -->
    </div>
<?php include 'inc/footer.php'; ?>