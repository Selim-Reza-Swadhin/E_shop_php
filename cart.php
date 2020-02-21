<?php include'inc/header.php'; ?>

<?php

if (isset($_GET['delpro'])){

    // $id = $_GET['delpro'];
    $delId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
    $delProduct = $ct->delProductByCart($delId);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     $cartId    = $_POST['cartId'];
    $quantity   = $_POST['quantity'];
    $updateCart = $ct->updateCartQuantity($cartId, $quantity);
    if ($quantity <= 0) {
        $delProduct = $ct->delProductByCart($cartId);
    }
}
?>

<!-- Auto Refresh -->
<?php
if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=selim'/>";
}
?>


 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>

                <?php
                if (isset($updateCart)) {
                    echo $updateCart;
                }

                if (isset($delProduct)) {
                    echo $delProduct;
                }
                ?>


						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

                    <?php
                        $getPro = $ct->getCartProduct();
                        if ($getPro) {
                            $i = 0;
                            $sum = 0;
                            $qty = 0;
                            while ($result = $getPro->fetch_assoc()) {
                            $i++;
                    ?>

							<tr>
								<td><?= $i; ?></td>
								<td><?= $result['productName']; ?></td>
								<td><img src="admin/<?= $result['image']; ?>" alt=""/></td>
								<td>$<?= $result['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?= $result['cartId']; ?>"/>
										<input type="number" name="quantity" value="<?= $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
                                <td>$<?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $total;
                                    ?>
                                </td>
								<td><a onclick="return confirm('Are You Sure Deleted!');" href="?delpro=<?= $result['cartId']; ?>">X</a></td>
                            </tr>
                                <?php
                                    $qty = $qty + $result['quantity'];
                                    $sum =$sum + $total;
                                    Session::set("qty", "$qty");
                                    Session::set("sum", "$sum");
                                ?>

                    <?php }} ?>

				</table>

				 <?php
                        $getData = $ct->checkCartTable();
                        if ($getData) {
                 ?>
                            <style>
                                .tbltwo{
                                width: 30%;
                                float: right;
                                text-align:left;
                                border: 2px solid #ddd;
                                margin-right: 14px;
                                margin-top: 10px;
                                }
                                .tbltwo tr th{
                                text-align: justify;
                                padding: 3px 8px;
                                }
                            </style>
						<table class="tbltwo">
							<tr>
								<th>Sub Total</th>
                                <td>:</td>
								<td>$<?= $sum; ?></td>
							</tr>
							<tr>
								<th>VAT</th>
                                <td>:</td>
								<td>10% ($<?= $sum * 0.1; ?>)</td>
							</tr>
							<tr>
								<th>Grand Total</th>
                                <td>:</td>
                                <td>$<?php
                                        $vat = $sum * 0.1;
                                        $gtotal = $sum + $vat;
                                        echo $gtotal;
                                    ?>
                                </td>
							</tr>
                            <tr>
                                <th>Quantity</th>
                                <td>:</td>
                                <td><?= $qty; ?></td>
                            </tr>
					   </table>
                <?php }else{
                            //echo "<span style='color:red;'>Cart Empty! Please shop now.</span>";
                            header("Location:index.php");
                        }?>
                <!-- ===========================================================
                                            Undefined variable: sum
                     =========================================================== -->

        <!--    <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td>$<?php
                            //if (isset($sum)) {
                                //echo $sum;
                            //}
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>10% ($<?php
                            //if (isset($sum)) {
                                //echo $sum * 0.1;
                            //}
                            ?>)
                        </td>

                        <th>Discount : </th>
                        <td>10% ($<?php
                            //if (isset($sum)) {
                                //echo $sum * 0.1;
                            //}
                            ?>)
                        </td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td>$<?php
                            //if (isset($sum)) {
                                //$vat = $sum * 0.1;
                                //$gtotal = $sum + $vat;
                                //echo $gtotal;
                            //}
                            ?>
                        </td>

                        <th>Grand Total :</th>
                        <td>$<?php
                            //if (isset($sum)) {
                                //$vat = $sum * 0.1;
                                //$gtotal = $sum - $vat;
                               // echo $gtotal;
                            //}
                            ?>
                        </td>
                    </tr>
                </table> -->
<!-- ---------------------- Undefined variable: sum -----end----------------- -->

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

