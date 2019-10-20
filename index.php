<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>

    <div class="bg"></div>
    <h3 style="margin-left: 20px; color:blue; font-weight: bold">List des produits</h3>
    <br>

<?php
if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    $query_display_users = "SELECT * FROM products where cat_id = $cat_id";
    $res_users = mysqli_query($connect, $query_display_users);
    if (!$res_users) {
        die('Check Failed to query' . mysqli_error($res_users));
    } else {
        while ($row = mysqli_fetch_assoc($res_users)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $product_image = $row['product_image'];
            echo "<div class=\"gallery\">
        <a target=\"_blank\" href=\"product.php?pro_id=$product_id\">
            <img class=\"img1\" src=\"admin/images/$product_image\" width=\"600\" height=\"400\">
        </a>
        <div class=\"desc\">$product_price</div>
    </div>";
        }
    }

} else {
    $cat_id = $_GET['cat_id'];
    $query_display_users = "SELECT * FROM products";
    $res_users = mysqli_query($connect, $query_display_users);
    $row_num = mysqli_num_rows($res_users);
    if ($row_num > 0) {
        if (!$res_users) {
            die('Check Failed to query' . mysqli_error($res_users));
        } else {
            while ($row = mysqli_fetch_assoc($res_users)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_image = $row['product_image'];
                echo "<div class=\"gallery\">
        <a target=\"_blank\" href=\"product.php?pro_id=$product_id\">
            <img class=\"img1\" src=\"admin/images/$product_image\" width=\"600\" height=\"400\">
        </a>
        <div class=\"desc\">$product_price</div>
    </div>";
            }
        }
    } else
        echo "<h3>La liste des produits est vide </h3>";

}
?>

<?php include "includes/footer.php" ?>