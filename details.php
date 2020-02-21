<?php include'inc/header.php'; ?>

<?php
/*Compare Before*/
/*if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo "<script>window.location = '404.php'</script>";
}else{
    // $id = $_GET['proid'];
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
}*/

/*Compare*/

if (isset($_GET['proid'])) {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $quantity   = $_POST['quantity'];
    $addCart = $ct->addToCart($quantity, $id);
}
?>

<?php
$cmrId = Session::get("cmrId");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
    $productId   = $_POST['productId'];
    $insertCom = $pd->insertCompareData($productId, $cmrId);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
    $saveWlist = $pd->saveWishListData($id, $cmrId);
}
?>

<style>
    .mybutton{
        width: 100px;
        float: left;
        margin-right: 30px;
    }
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">

                    <?php
                        $getPd = $pd->getSingleProduct($id);
                    if ($getPd) {
                        while ($result = $getPd->fetch_assoc()) {
                    ?>

					<div class="grid images_3_of_2">
						<img src="admin/<?= $result['image']; ?>" alt="" />
					</div>

				<div class="desc span_3_of_2">
                        <h2><?= $result['productName']; ?></h2>
                        <div class="price">
                            <p>Price: <span>$<?= $result['price']; ?></span></p>
                            <p>Category: <span><?= $result['catName']; ?></span></p>
                            <p>Brand:<span><?= $result['brandName']; ?></span></p>
                        </div>
                        <div class="add-cart">
                            <form action="" method="post">
                                <input type="number" class="buyfield" name="quantity" value="1"/>
                                <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                            </form>
                        </div>
                    <span style="color:red; font-size: 18px;">
                        <?php
                        if (isset($addCart)) {
                            echo $addCart;
                        }
                        ?>
                    </span>
                    <?php
                    if (isset($insertCom)) {
                        echo $insertCom;
                    }
                    if (isset($saveWlist)) {
                        echo $saveWlist;
                    }
                    ?>
                    <?php
                        $login = Session::get("cuslogin");
                        if ($login == true) { ?>
                        <div class="add-cart">
                            <div class="mybutton">
                            <form action="" method="post">
                                <input type="hidden" class="buyfield" name="productId" value="<?= $result['productId']; ?>"/>
                                <input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
                            </form>
                            </div>
                           <div class="mybutton">
                            <form action="" method="post">
                                <input type="submit" class="buysubmit" name="wlist" value="Save To List"/>
                            </form>
                        </div>
                        </div>
                    <?php }?>
			    </div>
                    <div class="product-desc">
                        <h2>Product Details</h2>
                        <p><?= $result['body']; ?></p>
                    </div>

                <?php }} ?>

                </div>

		<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
                        <?php
                            $getCat = $cat->getAllCat();
                            if ($getCat) {
                            //$i = 0;
                            while ($result = $getCat->fetch_assoc()) {
                            //$i++;
                        ?>
				      <li><a href="productbycat.php?catId=<?= $result['catId']; ?>"><?= $result['catName']; ?></a></li>
				        <?php }} ?>
    				</ul>

 				</div>
 		</div>
 	</div>

</div>

	<?php include'inc/footer.php'; ?>
