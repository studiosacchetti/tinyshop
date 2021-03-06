<?php
session_start();
require_once '../config/connect.php';

if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
    header('location: login.php');
}



$uid = $_SESSION['customerid'];
// $cart = $_SESSION['cart'];
$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

if (isset($_POST) & !empty($_POST)) {
    $company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $address1 = filter_var($_POST['address1'], FILTER_SANITIZE_STRING);
    $address2 = filter_var($_POST['address2'], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
    $zip = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $vat = filter_var($_POST['vat'], FILTER_SANITIZE_NUMBER_INT);

    //var_dump($_FILES);
    if (isset($_FILES) & !empty($_FILES)) {
        $name = $_FILES['logo']['name'];
        $size = $_FILES['logo']['size'];
        $type = $_FILES['logo']['type'];
        $tmp_name = $_FILES['logo']['tmp_name'];

        $max_size = 10000000;
        $extension = substr($name, strpos($name, '.') + 1);

        if (isset($name) && !empty($name)) {
            if (($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $size <= $max_size) {
                $location = "images/";
                $filepath = $location . "logo.jpg";
                if (move_uploaded_file($tmp_name, $filepath)) {
                    $smsg = "Uploaded Successfully";
                } else {
                    $fmsg = "Failed to Upload File";
                }
            } else {
                $fmsg = "Only JPG files are allowed and should be less that 1MB";
            }
        } else {
            $fmsg = "Please Select a File";
        }
    }

    // update data in config table
    $usql = "UPDATE config SET firstname='$fname', lastname='$lname', address1='$address1', address2='$address2', city='$city', state='$state',  zip='$zip', company='$company', phone='$phone', vat='$vat'";
    $ures = mysqli_query($connection, $usql) or die(mysqli_error($connection));
    if ($ures) {
        $smsg = "Category Updated";
    } else {
        $fmsg = "Failed Update Category";
    }
}

$sql = "SELECT * FROM config";
$res = mysqli_query($connection, $sql);
$r = mysqli_fetch_assoc($res);

include 'inc/header.php';
include 'inc/nav.php';
?>


<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="page_header text-center">
            <h2>Edit Config</h2>
            <!--<p>Get the best kit for smooth shave</p>-->
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="container">
                <?php if (isset($fmsg)) { ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
                <?php if (isset($smsg)) { ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="billing-details">
                            <h3 class="uppercase">Update system config</h3>
                            <div class="space30"></div>
                            <label>Company Name</label>
                            <input name="company" class="form-control" placeholder="company name (optional)" 
                                   value="<?php
                                   if (!empty($r['company'])) {
                                       echo $r['company'];
                                   } elseif (isset($company)) {
                                       echo $company;
                                   }
                                   ?>" type="text">
                            <div class="clearfix space20"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name </label>
                                    <input name="fname" class="form-control" placeholder="first name" 
                                           value="<?php
                                           if (!empty($r['firstname'])) {
                                               echo $r['firstname'];
                                           } elseif (isset($fname)) {
                                               echo $fname;
                                           }
                                           ?>" type="text" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name </label>
                                    <input name="lname" class="form-control" placeholder="last name" 
                                           value="<?php
                                           if (!empty($r['lastname'])) {
                                               echo $r['lastname'];
                                           } elseif (isset($lname)) {
                                               echo $lname;
                                           }
                                           ?>" type="text" required>
                                </div>
                            </div>                            
                            <div class="clearfix space20"></div>
                            <label>Address </label>
                            <input name="address1" class="form-control" placeholder="Street address" 
                                   value="<?php
                                   if (!empty($r['address1'])) {
                                       echo $r['address1'];
                                   } elseif (isset($address1)) {
                                       echo $address1;
                                   }
                                   ?>" type="text">
                            <div class="clearfix space20"></div>
                            <input name="address2" class="form-control" placeholder="Apartment, suite, unit etc. (optional)" 
                                   value="<?php
                                   if (!empty($r['address2'])) {
                                       echo $r['address2'];
                                   } elseif (isset($address2)) {
                                       echo $address2;
                                   }
                                   ?>" type="text">
                            <div class="clearfix space20"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>City </label>
                                    <input name="city" class="form-control" placeholder="City" 
                                           value="<?php
                                           if (!empty($r['city'])) {
                                               echo $r['city'];
                                           } elseif (isset($city)) {
                                               echo $city;
                                           }
                                           ?>" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label>State</label>
                                    <input name="state" class="form-control" placeholder="State" 
                                           value="<?php
                                           if (!empty($r['state'])) {
                                               echo $r['state'];
                                           } elseif (isset($state)) {
                                               echo $state;
                                           }
                                           ?>" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label>Postcode </label>
                                    <input name="zipcode" class="form-control" placeholder="Postcode / Zip" 
                                           value="<?php
                                           if (!empty($r['zip'])) {
                                               echo $r['zip'];
                                           } elseif (isset($zip)) {
                                               echo $zip;
                                           }
                                           ?>" type="text">
                                </div>
                            </div>
                            <div class="clearfix space20"></div>
                            <label>Phone </label>
                            <input name="phone" class="form-control" placeholder="Phone" 
                                   value="<?php
                                   if (!empty($r['phone'])) {
                                       echo $r['phone'];
                                   } elseif (isset($phone)) {
                                       echo $phone;
                                   }
                                   ?>" type="text">
                            <div class="clearfix space20"></div>
                            <label>Shipping </label>
                            <input name="shipping" class="form-control" placeholder="Shipping cost" 
                                   value="<?php
                                   if (!empty($r['shipping'])) {
                                       echo $r['shipping'];
                                   } elseif (isset($shipping)) {
                                       echo $shipping;
                                   }
                                   ?>" type="number">
                            <div class="clearfix space20"></div>
                            <label>Vat </label>
                            <input name="vat" class="form-control" placeholder="Vat No." 
                                   value="<?php
                                   if (!empty($r['vat'])) {
                                       echo $r['vat'];
                                   } elseif (isset($vat)) {
                                       echo $vat;
                                   }
                                   ?>" type="text">
                            <div class="clearfix space20"></div>
                            <label>Product Image</label>
                            <br>
                            <img src="images/logo.jpg" width="200px" height="100px">                            
                            <input type="file" name="logo" id="logo">
                            <p class="help-block">Only jpg/png are allowed.</p>
                            <div class="space30"></div>
                            <input type="submit" class="button btn-lg" value="Update Config">
                        </div>
                    </div>

                </div>

            </div>		
        </form>		
    </div>
</section>

<?php include 'inc/footer.php' ?>
