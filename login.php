<?php include "includes/header.php" ?>
<?php include "includes/navbar.php"?>

    <div class="stand">
        <div class="outer-screen">
            <div class="inner-screen">
                <form action="database/login.php" method="post">
                <div id="login" class="form" >
                    <input type="text" class="zocial-dribbble" name="username" laceholder="Enter your username" />
                    <input type="password" name="password" placeholder="Enter your password" required/>
                    <input type="submit" name="login" value="Login" />
                    <a class="forget" href="">Lost your password?</a>
                </div>
                </form>
            </div>
        </div>
    </div>

<?php include "includes/footer.php" ?>