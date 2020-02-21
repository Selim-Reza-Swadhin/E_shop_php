<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
$filepath = realpath(dirname(__FILE__));// No such file or directory is Solution
include_once($filepath.'/../classes/Cart.php');
?>

<?php

if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo "<script>window.location = 'inbox.php'</script>";
}else{
    // $id = $_GET['custId'];
    $cmrId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product Details</h2>
        <div class="block copyblock">

            <?php
            $cus = new Cart();
            $getCust = $cus->getOrderedProduct($cmrId);
            if($getCust) {
                while ($result = $getCust->fetch_All()) {

            ?>
            <h2><?= $result['productName']; ?></h2>

           <?php }} ?>

                </div>
    </div>
</div>
<?php include 'inc/footer.php';?>

