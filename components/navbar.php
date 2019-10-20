<?php
session_start();
?>
<div class="navBarStyle">
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Categories</a>
            <div class="dropdown-content">
            <?PHP
                $categories = unserialize(file_get_contents("database/categories"));
                foreach ($categories as $name => $array)
                    echo "<a href=\"index.php?category=$name\">$name</a>";
            ?>
            </div>
        </li>
        <?php
            if (isset($_SESSION[loggued_on_user]) && $_SESSION[loggued_on_user] != NULL) {
                echo"
                <li style=\"float:right\"><a href=\"include/logout.php\">Logout</a></li>";
                $users = unserialize(file_get_contents('database/users'));
                if ($users[$_SESSION[loggued_on_user]][permission] == 1)
                    echo "<li style=\"float:right\"><a href=\"/admin.php\">admin</a></li>";
            } else {
                echo "
                <li style=\"float:right\"><a href=\"login.php\">Login</a></li>
                <li style=\"float:right\"><a href=\"register.php\">Register</a></li>";
            } 
            ?>
        <li style="float:right"><a href="basket.php">Shopping Cart</a></li>
    </ul>
</div>
