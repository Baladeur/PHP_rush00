<div class="navBarStyle">
    <ul>
        <li><a class="active" href="#home">Home</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Categories</a>
            <div class="dropdown-content">
            <?PHP
                $categories = unserialize(file_get_contents("database/categories"));
                foreach ($categories as $name => $array)
                    echo "<a href=\"#\">$name</a>";
            ?>
            </div>
        </li>
        <li style="float:right"><a href="login.php">Login</a></li>
        <li style="float:right"><a href="register.php">Register</a></li>
        <li style="float:right"><a href="basket.php">Shopping Cart</a></li>
    </ul>
</div>
