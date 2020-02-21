<?php include'inc/header.php'; ?>

<?php
$login = Session::get("cuslogin");
if ($login == false) {
    header("Location:login.php");
}
?>

<style>
.psuccess{
    width: 500px;
    min-height: 200px;
    text-align: center;
    border: 1px solid #ddd;
    margin: 0 auto;
    padding: 20px;
}
.psuccess h2{
    border-bottom: 1px solid #ddd;
    margin-bottom: 20px;
    padding-bottom: 10px;
}
.psuccess a{
    /*background: #ff0000 none repeat scroll 0 0;*/
    /*color: white;*/
    border-radius: 3px;
    font-size: 25px;
    padding: 5px 30px;
    }

.success p{
    line-height: 25px;
    font-size: 18px;
    text-align: left;
}

</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="psuccess">
                <h2 style="color:lawngreen">Success</h2>

                <?php
                    $cmrId = Session::get("cmrId");
                    $amount = $ct->payableAmount($cmrId);
                if ($amount) {
                    $sum = 0;
                    while ($result = $amount->fetch_assoc()) {
                        $price = $result['price'];
                        $sum = $sum + $price;
                    }
                }
                ?>
                <p>Total Payable Amount(Including Vat) : $

                        <?php
                        $vat = $sum * 0.1;
                        $total = $vat + $sum;
                        echo $total;
                        ?>
                </p>
<!-- undefined vat -->
                <!--<style>
                    background: green;
                    border: 1px solid red;
                    padding: 5px 8px;
                    border-radius: 50%;
                    color:#fff;
                </style>
                <p>Total Payable Amount(Including Vat) :$
                    <span>
                        <?php
/*                        if (!isset($sum)) {
                            echo "Sorry No Product!";
                        }else{
                            $vat = $sum * 0.1;
                            if (!isset($vat)) {
                                echo "";
                            }else{
                                $total = $vat + $sum;
                                echo $total;
                            }
                        }

                        */?>
                    </span>
                </p>-->

                <p>Thanks for Purchase. Receive Your Order Successfully. We will contact you ASAP with delivery details...
                    <a href="orderdetails.php">Visit Here...</a></p>
            </div>
        </div>
    </div>

</div>

<?php include'inc/footer.php'; ?>


