<?php include "includes/header.php" ?>
<?php include "includes/navbar.php"?>

    <div class="stand">
        <div class="outer-screen">
            <div class="inner-screen">
                <form action="database/register.php" method="post">
                <div class="form">
                    <input type="text" class="zocial-dribbble" name="username" placeholder="Enter your username" />
                    <input type="email" class="zocial-dribbble" name="email" placeholder="Enter your email" required/>
                    <input type="password" name="password" placeholder="Enter your password" required/>
                    <input type="submit" name="submit_register" value="Inscription" />
                    <a class="forget" href="">Lost your password?</a>
                </div>
                </form>
                <?php
                    if (isset($_GET['key'])){
                        echo "<ceneter><div  class='btnt'><form action=\"register.php?del=1\" method=\"post\">
                    <div>
                        <input  type=\"submit\" name=\"submit_register\" value=\"Ou vider votre panier\" />
                    </div>
                </form></div></ceneter>";
                    }
                ?>
            </div>
        </div>
    </div>

<style>
    .btnt {
        float:;
        height: 100px;
        padding-top: 60px;
        background-color: silver;
    }
</style>


<?php
if (isset($_GET['del'])){
    $query = "DELETE FROM basket WHERE user_basket_id = 0 ";
    $res_del_post = mysqli_query($connect, $query);
    if (!$res_del_post) {
        die('Failed to query: ' . mysqli_error($connect));
    }
    echo "<script>
            alert('Votr panier est vide vous pouvez reessayer encore');
        </script>";
}
?>

<?php include "includes/footer.php" ?>