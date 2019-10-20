<?php
session_start();
?>
<div class="navBarStyle">
    <ul>
        <li><a class="active" href="#home">Home</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Categories</a>
            <div class="dropdown-content">
                <a href="#">Category 1</a>
                <a href="#">Category 2</a>
                <a href="#">Category 3</a>
            </div>
        </li>
        <?php
            if (isset($_SESSION['loggued_on_user']) && $_SESSION('loggued_on_user') != NULL) {
                echo"
                <li style=\"float:right\"><a href=\"/logout.php\">Logout</a></li>";
                // If user is an admin
                echo "<li style=\"float:right\"><a href=\"/admin.php\">admin</a></li>";
            } else {
                echo "
                <li style=\"float:right\"><a href=\"/login.php\">Login</a></li>
                <li style=\"float:right\"><a href=\"/register.php\">Register</a></li>";
            } 
            ?>
        <li style="float:right"><a href="/basket.php">Shopping Cart</a></li>
    </ul>
</div>
