<?php include'inc/header.php'; ?>
<style>
    .tblone td img{width: 100px;height: 90px;}
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Compare</h2>

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
                    $getPd = $pd->getCompareData($cmrId);
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
                                <td><a href="details.php?proid=<?= $result['productId']; ?>">View</a></td>
                            </tr>

                        <?php }} ?>

                </table>

            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>


<?php include'inc/footer.php'; ?>


