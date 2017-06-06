<?php include 'inc/header.php'; ?>
<?php include 'inc/side_bar.php'; ?>
<?php require_once '../classes/Category.php'; ?>

<?php
$cat = new Category();

if (isset($_GET['del_cat'])) {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['del_cat']);
    $del_cat = $cat->delCategory($id);
}
?>
    <div class="col-md-9 col-sm-8">
        <div class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Список категорий</strong></div>
                <div class="panel-body">
                    <?php
                    if (isset($del_cat)) {
                        echo $del_cat;
                    }
                    ?>
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Название категории</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $get_cat = $cat->getAllCat();
                        if ($get_cat) {
                            $i = 0;
                            while ($result = $get_cat->fetch_assoc()) {
                                $i++; ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $result['cat_name']; ?></td>
                                    <td><a href="cat_edit.php?cat_id=<?= $result['cat_id']; ?>"
                                           class="btn btn-primary btn-xs" title="редактировать"><i
                                                    class="fa fa-pencil"></i></a> ||
                                        <a onclick="return confirm('Вы уверены, что хотите удалить!');"
                                           href="?del_cat=<?= $result['cat_id']; ?>" class="btn btn-danger btn-xs"
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
        </div><!-- main-content -->
    </div>
<?php include 'inc/footer.php'; ?>