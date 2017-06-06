<?php include 'inc/header.php'; ?>
<?php include 'inc/side_bar.php'; ?>
<?php require_once '../classes/Brand.php'; ?>

<?php
$brand = new Brand();

if (isset($_GET['del_brand'])) {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['del_brand']);
    $del_brand = $brand->delBrand($id);
}
?>
    <div class="col-md-9 col-sm-8">
        <div class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Список брендов</strong></div>
                <div class="panel-body">
                    <?php
                    if (isset($del_brand)) {
                        echo $del_brand;
                    }
                    ?>
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Название бренда</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $get_brand = $brand->getAllBrand();
                        if ($get_brand) {
                            $i = 0;
                            while ($result = $get_brand->fetch_assoc()) {
                                $i++; ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $result['brand_name']; ?></td>
                                    <td><a href="brand_edit.php?brand_id=<?= $result['brand_id']; ?>"
                                           class="btn btn-primary btn-xs" title="редактировать"><i
                                                class="fa fa-pencil"></i></a> ||
                                        <a onclick="return confirm('Вы уверены, что хотите удалить!');"
                                           href="?del_brand=<?= $result['brand_id']; ?>" class="btn btn-danger btn-xs"
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