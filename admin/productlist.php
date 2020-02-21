<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';?>
<?php include_once '../helpers/Format.php';?>

<?php
    $pd = new Product();
    $fm = new Format();
?>
<?php

if (isset($_GET['delpro'])) {
    // $id = $_GET['delpro'];
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
    $delPro = $pd->delProById($id);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>

        <?php
        if (isset($delPro)) {
            echo $delPro;
        }
        ?>

        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL NO.</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
            <?php
                    $getPd = $pd->getAllProduct();
                if ($getPd) {
                    $i = 0;
                while ($result = $getPd->fetch_assoc()) {
                    $i++;
            ?>
				<tr class="odd gradeX">
                    <td><?= $i; ?></td>
                    <td><?= $result['productName']; ?></td>
                    <!--<td><?/*= //$result['catId']; */?></td>
                    <td><?/*= //$result['brandId']; */?></td>-->
                    <td><?= $result['catName']; ?></td>
                    <td><?= $result['brandName']; ?></td>
                    <td><?= $fm->textShorten($result['body'], 40); ?></td>
                    <td>$<?= $result['price']; ?></td>
                    <td><img src="<?= $result['image']; ?>" alt=""height="40px" width="60px"></td>
                    <td>
                        <?php
                        if ($result['type'] == 0) {
                            echo "Featured";
                        }else{
                            echo "General";
                        }
                        ?>
                    </td>
                    <td><a href="productedit.php?proid=<?= $result['productId'];?>">Edit</a> || <a onclick="return confirm('Are you sure deleted your matter')" href="?delpro=<?= $result['productId'];?>">Delete</a></td>
				</tr>

            <?php }} ?>

			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
