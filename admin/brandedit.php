<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include'../classes/Brand.php'; ?>

<?php

if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    echo "<script>window.location = 'brandlist.php'</script>";
}else{
    // $id = $_GET['catid'];
       $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brandid']);
}

$brand = new Brand();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $brandName   = $_POST['brandName'];
    $updateBrand = $brand->brandUpdate($brandName, $id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Brand</h2>
        <div class="block copyblock">

            <?php
            if (isset($updateBrand)) {
                echo $updateBrand;
            }
            ?>

            <?php
            $getBrand = $brand->getBrandById($id);
            if ($getBrand) {
                while ($result = $getBrand->fetch_assoc()) {

                    ?>

                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" name="brandName" value="<?= $result['brandName'];?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit"  Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>

                <?php }} ?>

        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
