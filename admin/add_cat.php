<?php include 'inc/header.php'; ?>
<?php include 'inc/side_bar.php'; ?>
<?php require_once '../classes/Category.php'; ?>

<?php
$cat = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_name = $_POST['cat_name'];
    $insert_cat = $cat->catInsert($cat_name);
}
?>
    <div class="col-md-9 col-sm-8">
        <div class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Добавить категорию продукта</strong></div>
                <div class="panel-body">
                    <?php
                        if (isset($insert_cat)){
                            echo $insert_cat;
                        }

                    ?>
                    <form action="add_cat.php" method="post">
                        <div class="form-block">
                            <input type="text" class="form-control" name="cat_name" placeholder="Введите название категории">
                            <input type="submit" name="submit" class="btn btn-success" value="Сохранить">
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- main-content -->
    </div>
<?php include 'inc/footer.php'; ?>