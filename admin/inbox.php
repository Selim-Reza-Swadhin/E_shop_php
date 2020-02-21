<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));// No such file or directory is Solution
include_once($filepath . '/../classes/Cart.php');
$ct = new Cart();
$fm = new Format();
?>

<?php
/*Shift*/
if (isset($_GET['shiftid'])) {
    $id = $_GET['shiftid'];
    $price = $_GET['price'];
    $time = $_GET['time'];
    $shift = $ct->productShifted($id, $time, $price);

}

/*Remove*/
if (isset($_GET['delproid'])) {
    $id = $_GET['delproid'];
    $price = $_GET['price'];
    $time = $_GET['time'];
    $delOrder = $ct->delProductShifted($id, $time, $price);

}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php
        if (isset($shift)) {
            echo $shift;
        }
        if (isset($delOrder)) {
            echo $delOrder;
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Order Time</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Cmr ID</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $getOrder = $ct->getAllOrderProduct();
                if ($getOrder) {
                    while ($result = $getOrder->fetch_assoc()) {
                        ?>
                        <tr class="odd gradeX">
                            <td><a href="productdetails.php?proid=<?= $result['id']; ?>"><?= $result['id']; ?></a></td>
                            <td><?= $fm->formatDate($result['date']); ?></td>
                            <td><?= $result['productName']; ?></td>
                            <td><?= $result['quantity']; ?></td>
                            <td>$<?= $result['price']; ?></td>
                            <td><?= $result['cmrId']; ?></td>
                            <td><a href="customer.php?custId=<?= $result['cmrId']; ?>">View Details</a></td>
                            <?php
                            if ($result['status'] == '0') { ?>
                                <td>
                                    <a href="?shiftid=<?= $result['cmrId']; ?> & price=<?= $result['price']; ?> & time=<?= $result['date']; ?>">Shifted</a>
                                </td>
                            <?php } elseif ($result['status'] == '1') {
                                ?>
                                <!--<td><a href="?delproid=--><? //=// $result['cmrId'];
                                ?><!-- & price=--><? //=// $result['price'];
                                ?><!-- & time=--><? //=// $result['date'];
                                ?><!--">Confirmed</a></td>-->
                                <td>Pending</td>
                            <?php } else {
                                ?>
                                <td>
                                    <a href="?delproid=<?= $result['cmrId']; ?> & price=<?= $result['price']; ?> & time=<?= $result['date']; ?>">Remove</a>
                                </td>
                            <?php } ?>

                        </tr>
                    <?php }
                } ?>
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
<?php include 'inc/footer.php'; ?>
