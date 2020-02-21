<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include'../classes/Catagory.php'; ?>
<?php
$cat = new Catagory();

if (isset($_GET['delcat'])) {
    // $id = $_GET['delcat'];
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcat']);
    $delCat = $cat->delCatById($id);
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
    if (isset($delCat)) {
        echo $delCat;
    }
?>

					<?php
						$getCat = $cat->getAllCat();
						if ($getCat) {
							$i = 0;
							while ($result = $getCat->fetch_assoc()) {
							$i++;
					?>			
					
						
						<tr class="odd gradeX">
							<td><?= $i;?></td>
							<td><?= $result['catName'];?></td>
							<td><a href="catedit.php?catid=<?= $result['catId'];?>">Edit</a> || <a onclick="return confirm('Are you sure deleted your matter')" href="?delcat=<?= $result['catId'];?>">Delete</a></td>
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

