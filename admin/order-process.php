<?php
ob_start();
session_start();
require_once '../config/connect.php';
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
    header('location: login.php');
}
include 'inc/header.php';
include 'inc/nav.php';
?>

<?php
if (isset($_POST) & !empty($_POST)) {
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $id = filter_var($_POST['orderid'], FILTER_SANITIZE_NUMBER_INT);

    $ordprcsql = "INSERT INTO ordertracking (orderid, status, message) VALUES ('$id', '$status', '$message')";
    $ordprcres = mysqli_query($connection, $ordprcsql) or die(mysqli_error($connection));
    if ($ordprcres) {
        $ordupd = "UPDATE orders SET orderstatus='$status' WHERE id=$id";
        if (mysqli_query($connection, $ordupd)) {
            header('location: orders.php');
        }
    }
}
?>


<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="page_header text-center">
            <h2>Admin - Order Processing</h2>
            <!-- <p>Do you want to cancel Order?</p> -->
        </div>
        <!-- @todo -->
        <div class="container">           
            <div class="row">
                <div class="col-md-12">
                    <div class="order-details">
                        <h3 style="text-align: center; padding-bottom: 10px;">Product Details</h3>
                        <table class="table table-striped table-bordered">
                        <!--<table class="cart-table account-table table table-bordered">-->
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Price</th>
                                    <th style="text-align: center;">Count</th>
                                    <th style="text-align: center;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Display ordered product details
                                $orderid = $_GET['id'];
                                $productdetailsql = "SELECT o.pquantity AS quantity, p.id AS id, p.name AS name, p.catid AS catid, p.price AS price, p.thumb AS thumb FROM orderitems o JOIN products p WHERE o.pid=p.id AND o.orderid='$orderid' ORDER BY p.id";
                                $productdetailres = mysqli_query($connection, $productdetailsql);
                                $productdetailresquan = mysqli_num_rows($productdetailres);
                                while ($productdetailr = mysqli_fetch_assoc($productdetailres)) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <?php echo $productdetailr['id']; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo $productdetailr['name']; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo $productdetailr['price']; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo $productdetailr['quantity']; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo $productdetailr['price'] * $productdetailr['quantity']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <!-- end @todo -->
            <div class="row"> 
                <form method="post">
                    <div class="col-md-6">
                        <div class="shipping-address">
                            <h3 style="text-align: center;  padding-bottom: 10px;">Shipping Address</h3>
                            <br>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Label</th>
                                        <th style="text-align: center;">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // find uid by order id
                                    $orderid = $_GET['id'];
                                    $finduidsql = "SELECT uid FROM orders WHERE id='$orderid'";
                                    $finduidres = mysqli_query($connection, $finduidsql);
                                    $finduidr = mysqli_fetch_assoc($finduidres);
                                    $uid = $finduidr['uid'];

                                    // Display user details
                                    $shippingsql = "SELECT * FROM usersmeta WHERE uid='$uid'";
                                    $shippingres = mysqli_query($connection, $shippingsql);
                                    while ($shippingr = mysqli_fetch_assoc($shippingres)) {
                                        ?>
                                        <tr>
                                            <th>User ID</th>
                                            <td>
                                                <?php echo $shippingr['uid']; ?>
                                            </td>
                                        <tr>
                                            <th>Customer Name</th>
                                            <td>
                                                <?php echo $shippingr['firstname'] . " " . $shippingr['lastname']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number</th>
                                            <td>
                                                <?php echo $shippingr['phone']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Company Name</th>
                                            <td>
                                                <?php echo $shippingr['company']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <td>
                                                <?php echo $shippingr['country']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td>
                                                <?php echo $shippingr['city']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <td>
                                                <?php echo $shippingr['state']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Zip</th>
                                            <td>
                                                <?php echo $shippingr['zip']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Address Line 1</th>
                                            <td>
                                                <?php echo $shippingr['address1']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Address Line 2</th>
                                            <td>
                                                <?php echo $shippingr['address2']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="billing-details">
                            <h3 style="text-align: center; padding-bottom: 10px;">Order Processing</h3>
                            <table class="cart-table account-table table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Payment Mode</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_GET['id']) & !empty($_GET['id'])) {
                                        $oid = $_GET['id'];
                                    } else {
                                        header('location: orders.php');
                                    }
                                    $ordsql = "SELECT * FROM orders WHERE id='$oid'";
                                    $ordres = mysqli_query($connection, $ordsql);
                                    while ($ordr = mysqli_fetch_assoc($ordres)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $ordr['id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $ordr['timestamp']; ?>
                                            </td>
                                            <td>
                                                <?php echo $ordr['orderstatus']; ?>			
                                            </td>
                                            <td>
                                                <?php echo $ordr['paymentmode']; ?>
                                            </td>
                                            <td>
                                                <?php echo $ordr['totalprice']; ?> Eu
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>	

                            <div class="space30"></div>
                            <label class="">Order Status </label>
                            <select name="status" class="form-control"  required>
                                <option value="">Select Status</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Dispatched">Dispatched</option>
                                <option value="Delivered">Delivered</option>
                            </select>

                            <div class="clearfix space20"></div>
                            <label>Message :</label>
                            <textarea class="form-control" name="message" cols="10"> </textarea>

                            <input type="hidden" name="orderid" value="<?php echo $_GET['id']; ?>">		 
                            <div class="space30"></div>
                            <input type="submit" class="button btn-lg" value="Update Order Status">
                        </div>
                    </div>
                </form>	
            </div>

        </div>		

    </div>
</section>

<?php include 'inc/footer.php' ?>
