<?php
session_start();
require_once '../config/connect.php';
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
    header('location: login.php');
}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>

<section id="content">
    <div class="content-blog">
        <div class="page_header text-center">
            <h2>List of Products</h2>
        </div>
        <div class="container">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Thumbnail</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT products.id, products.`name`, category.`name` AS category, products.thumb FROM category INNER JOIN products ON category.id = products.catid";
                    $res = mysqli_query($connection, $sql);
                    while ($r = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $r['id']; ?></th>
                            <td><?php echo substr($r['name'], 0, 40) ?>..</td>
                            <td><?php echo $r['category']; ?></td>
                            <td><?php
                                if ($r['thumb']) {
                                    echo "Yes";
                                } else {
                                    echo "No";
                                }
                                ?>
                            </td>
                            <td><a href="editproduct.php?id=<?php echo $r['id']; ?>">Edit</a> | <a href="delproduct.php?id=<?php echo $r['id']; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</section>
<?php include 'inc/footer.php' ?>
