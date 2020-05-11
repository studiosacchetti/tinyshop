<?php
ob_start();
session_start();
require_once 'config/connect.php';
if (!isset($_SESSION['customer']) & empty($_SESSION['customer'])) {
    header('location: login.php');
}

include 'inc/header.php';
include 'inc/nav.php';
$uid = $_SESSION['customerid'];
    // $cart = $_SESSION['cart'];
    $cart=[ ];
    if(isset($_SESSION['cart'])){
$cart = $_SESSION['cart'];
    }
?>

<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog content-account">
        <div class="container">
            <div class="row">
                <div class="page_header text-center">
                    <h2>My Wishlist</h2>
                    <p></p>
                </div>
                <?php
                    $wishsql = "SELECT p.id AS pid, p.name, p.price , w.id AS wid, w.`timestamp` FROM wishlist w JOIN products p WHERE w.pid=p.id AND w.uid=$uid";
                    $wishres = mysqli_query($connection, $wishsql);

                    $wishqnt = mysqli_num_rows($wishres);

                    // echo $wishqnt;
                    if($wishqnt != 0) {
                ?>
                <div class="col-md-12">

                    <h3>Wishlisted Products</h3>
                    <br>
                    <table class="cart-table account-table table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Added On</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while($wishr = mysqli_fetch_assoc($wishres)){ ?>
                                <tr>
                                    <td>
                                        <a href="single.php?id=<?php echo $wishr['pid']; ?>"><?php echo $wishr['name']; ?></a>
                                    </td>
                                    <td>
                                    <?php echo $wishr['price']; ?> Eu
                                    </td>
                                    <td>
                                        <?php echo $wishr['timestamp']; ?>			
                                    </td>
                                    <td>
                                        <a href="delwishlist.php?id=<?php echo $wishr['wid']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>		

                    <br>
                    <br>
                    <br>
                </div>

                <?php } else { ?>

                    <div>
                        <h2>Your wishlist is empty!</h2>
                        <p>Lets look for a <a href="index.php">products</a> you wish to buy.</p>
                </div>
                    <div class="clearfix space70"></div>
                    <div class="clearfix space20"></div>
                    <div class="clearfix space20"></div>

                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php include 'inc/footer.php' ?>
