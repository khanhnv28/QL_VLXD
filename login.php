<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require "inc/init.php";
//echo password_hash("123", PASSWORD_DEFAULT);
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $error = Auth::login($name, $pass);
}
?>
<?php include "inc/header.php" ?>
<div class="col ">
<h1 class="text-center mt-2">ĐĂNG NHẬP</h1>
<form class="m-auto w-50" method="post">
    <div class="mb-3">
        <label for="name" class="form-label"><b>UserName</b></label>
        <input class="form-control" type="text" placeholder="Enter your UserName" name="name" id="name" />
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label"><b>Password</b></label>
        <input class="form-control" type="password" placeholder="••••••••••••••••••••••••••••" name="pass" id="pass" />
    </div>
    <div class="pt-2 text-center">
        <button type="submit" class="btn btn-danger text-white">ĐĂNG NHẬP</button><br />
        <span class="text-danger"><?= $error ?></span>
    </div>
</form>
</div>
<?php include "inc/footer.php" ?>