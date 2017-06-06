<?php include 'inc/header.php'; ?>
<?php include 'inc/side_bar.php'; ?>
<?php require_once '../classes/Category.php'; ?>

<?php
if (!isset($_GET['cat_id']) && $_GET['cat_id'] == null) {
    echo "<script>window.location ='cat_list.php'; </script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['cat_id']);
}
$cat = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_name = $_POST['cat_name'];
    $update_cat = $cat->catUpdate($cat_name, $id);
}
?>
    <div class="col-md-9 col-sm-8">
        <div class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Редактировать категорию продукта</strong></div>
                <div class="panel-body">
                    <?php
                    if (isset($update_cat)) {
                        echo $update_cat;
                    }
                    ?>
                    <?php
                    $get_cat = $cat->getCatById($id);
                    if ($get_cat) {
                        while ($result = $get_cat->fetch_assoc()) {
                            ?>
                            <form action="" method="post">
                                <div class="form-block">
                                    <input type="text" class="form-control" name="cat_name"
                                           value="<?= $result['cat_name']; ?>">
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