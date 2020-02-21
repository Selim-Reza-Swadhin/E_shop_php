<?php include'inc/header.php'; ?>

<?php

if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
    echo "<script>window.location = '404.php'</script>";
}else{
    // $id = $_GET['catId'];
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);
}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
                <?php
                $productbycat = $cat->getCatById($id);
                    if (isset($productbycat)) {
                     while ($result = $productbycat->fetch_assoc()) {
                ?>
    		      <h3>Latest from <?php echo $result['catName']; ?></h3>
                <?php }} ?>

    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

              <?php
                $productbycat = $pd->productByCat($id);
              if ($productbycat) {
                  while ($result = $productbycat->fetch_assoc()) {
              ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?= $result['productId']; ?>"><img src="admin/<?= $result['image']; ?>" alt="" /></a>
					 <h2><?= $result['productName']; ?></h2>
					 <p><?= $fm->textShorten($result['body'], 30); ?></p>
					 <p><span class="price">$<?= $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?= $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
              <?php }}else{
                  echo "<p>Products of this category are not available!</p>";
                  //header("Location:404.php");
              } ?>
			</div>

	
	
    </div>
 </div>

<?php include'inc/footer.php'; ?>

