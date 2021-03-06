<div class="menu-wrap">
    <div id="mobnav-btn">Menu <i class="fa fa-bars"></i></div>
    <ul class="sf-menu">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="#">Products</a>
            <div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
            <ul>
                <?php
                $catsql = "SELECT * FROM category";
                $catres = mysqli_query($connection, $catsql);
                while ($catr = mysqli_fetch_assoc($catres)) {
                    ?>
                    <li><a href="index.php?id=<?php echo $catr['id']; ?>"><?php echo $catr['name']; ?></a></li>
                <?php } ?>
            </ul>
        </li>
        <?php
        if (isset($_SESSION['customer']) & !empty($_SESSION['customer'])) {
            ?>
            <li>
                <a href="#">My Account</a>
                <div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
                <ul>
                    <li><a href="my-account.php">My Orders</a></li>
                    <li><a href="wishlist.php">My Wishlist</a></li>
                    <li><a href="edit-detail.php">My Details</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        <?php } else { ?>
            <li>
                <a href="#">Account</a>
                <div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
                <ul>
                    <li><a href="login.php" style="text-align: center; font-size: 14px;">Login</a></li>
                </ul>
            </li>
        <?php } ?>
        <li>
            <a href="#">Contact</a>
        </li>
    </ul>
    <div class="header-xtra">
        <?php
        $cart = [];
        $quan = 0;
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            foreach ($cart as $key => $value) {
                $quan = $quan + $value['quantity'];
            }
        }
        ?>
        <div class="s-cart">
            <div class="sc-ico">
                <i class="fa fa-shopping-cart"></i><em><?php echo $quan; ?></em>
            </div>

            <div class="cart-info">
                <small>You have <em class="highlight"><?php echo $quan; ?> item(s)</em> in your shopping bag</small>
                <br>
                <br>
                <?php
                if (!empty($cart)) {
//print_r($cart);
                    $total = 0;
                    foreach ($cart as $key => $value) {
                        //echo $key . " : " . $value['quantity'] ."<br>";
                        $navcartsql = "SELECT * FROM products WHERE id=$key";
                        $navcartres = mysqli_query($connection, $navcartsql);
                        $navcartr = mysqli_fetch_assoc($navcartres);
                        ?>
                        <div class="ci-item">
                            <img src="admin/<?php echo $navcartr['thumb']; ?>" width="70" alt=""/>
                            <div class="ci-item-info">
                                <h5><a href="single.php?id=<?php echo $navcartr['id']; ?>"><?php echo substr($navcartr['name'], 0, 20); ?></a></h5>
                                <p><?php echo $value['quantity']; ?> x Eu <?php echo $navcartr['price']; ?></p>
                                <div class="ci-edit">
                                    <!-- <a href="#" class="edit fa fa-edit"></a> -->
                                    <a href="delcart.php?id=<?php echo $key; ?>" class="edit fa fa-trash"></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $total = $total + ($navcartr['price'] * $value['quantity']);
                    }
                    ?>
                    <div class="ci-total">Subtotal: <?php echo $total; ?> Eu</div>
                    <div class="cart-btn">
                        <a href="cart.php">View Cart</a>
                        <a href="checkout.php">Checkout</a>
                    </div>
                <?php } else { ?>

                    <div></div>

                <?php } ?>
            </div>
        </div>
        <div class="s-search">
            <div class="ss-ico"><i class="fa fa-search"></i></div>
            <div class="search-block">
                <div class="ssc-inner">
                    <form action="searchresults.php" method="get">
                        <input name="search" type="text" placeholder="Type Search text here...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</header>