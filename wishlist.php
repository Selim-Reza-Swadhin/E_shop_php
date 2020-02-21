<?php include'inc/header.php'; ?>
<?php
if (isset($_GET['delwlistid'])) {
    $cmrId = Session::get("cmrId");
    $productId = $_GET['delwlistid'];
    $delWlist = $pd->delWlistData($cmrId, $productId);
}
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Wish List</h2>

                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    $cmrId = Session::get("cmrId");
                    $getPd = $pd->getWlistData($cmrId);
                    if ($getPd) {
                        $i = 0;
                        while ($result = $getPd->fetch_assoc()) {
                            $i++;
                            ?>

                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $result['productName']; ?></td>
                                <td><img src="admin/<?= $result['image']; ?>" alt=""/></td>
                                <td>$<?= $result['price']; ?></td>
                                <td>
                                    <a href="details.php?proid=<?= $result['productId']; ?>">Buy Now</a> ||
                                    <a href="?delwlistid=<?= $result['productId']; ?>">Remove</a>
                                </td>
                            </tr>

                        <?php }} ?>

                </table>

            </div>

            <style>
                .shopleft img{
                    outline:none;
                    margin-left: 400px;}
            </style>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>


<?php include'inc/footer.php'; ?>


