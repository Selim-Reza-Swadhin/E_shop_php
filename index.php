<?php include'inc/header.php'; ?>
<?php include'inc/slider.php'; ?>

<?php
//$filepath = realpath(dirname(__FILE__));
//echo $filepath; //G:\wamp64\www\E_Shop, this is realpath
?>

<?php
//    echo session_id();
?>

 <div class="main">
    <div class="content">

    	<div class="content_top">
    		<div class="heading">
    		    <h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>

	      <div class="section group">
              <?php
              $getFpd = $pd->getFeaturedProduct();
              if ($getFpd) {
                  while ($result = $getFpd->fetch_assoc()) {
                      ?>
                      <div class="grid_1_of_4 images_1_of_4">
                          <a href="details.php?proid=<?= $result['productId']; ?>"><img src="admin/<?= $result['image']; ?>" alt=""/></a>
                          <h2><?= $result['productName']; ?></h2>
                          <p><?= $fm->textShorten($result['body'], 50); ?></p>
                          <p><span class="price">$<?= $result['price']; ?></span></p>
                          <div class="button"><span><a href="details.php?proid=<?= $result['productId']; ?>" class="details">Details</a></span></div>
                      </div>
                  <?php }} ?>

			</div>

			<div class="content_bottom">
                <div class="heading">
                 <h3>New Products</h3>
                </div>
                <div class="clear"></div>
    	    </div>


			<div class="section group">

                    <?php
                    $getNpd = $pd->getNewProduct();
                    if ($getNpd) {
                        while ($result = $getNpd->fetch_assoc()) {
                    ?>
                            <div class="grid_1_of_4 images_1_of_4">
                                <a href="details.php?proid=<?= $result['productId']; ?>"><img src="admin/<?= $result['image']; ?>" alt=""/></a>
                                <h2><?= $result['productName']; ?></h2>
                                <p><?= $fm->textShorten($result['body'], 50); ?></p>
                                <p><span class="price">$<?= $result['price']; ?></span></p>
                                <div class="button"><span><a href="details.php?proid=<?= $result['productId']; ?>" class="details">Details</a></span></div>
                            </div>
                    <?php }} ?>

			</div>


    </div>
 </div>

 <?php include'inc/footer.php'; ?>

