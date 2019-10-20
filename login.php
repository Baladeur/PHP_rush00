<?php include "components/header.php" ?>
<?php include "components/navbar.php" ?>

<div class="panda">
    <div class="ear"></div>
    <div class="face">
        <div class="eye-shade"></div>
        <div class="eye-white">
            <div class="eye-ball"></div>
        </div>
        <div class="eye-shade rgt"></div>
        <div class="eye-white rgt">
            <div class="eye-ball"></div>
        </div>
        <div class="nose"></div>
        <div class="mouth"></div>
    </div>
    <div class="body"> </div>
    <div class="foot">
        <div class="finger"></div>
    </div>
    <div class="foot rgt">
        <div class="finger"></div>
    </div>
</div>
<form style="height: 359px" action="include/login.php" method="POST">
    <div class="hand"></div>
    <div class="hand rgt"></div>
    <h1>Login</h1>
    <div class="form-group">
        <input required="required" class="form-control" name="login"/>
        <label class="form-label">Username </label>
    </div>
    <div class="form-group">
        <input id="password" type="password" required="required" class="form-control" name = "passwd"/>
        <label class="form-label">Password</label>
        <p class="alert">Invalid Credentials..!!</p>
        <button class="btn">Login </button>
    </div>
</form>


<?php include "components/footer.php" ?>