<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require "inc/init.php";

$noti = "";
$ten = "";
$pass = "";
$enterThePass = "";

$tenErrors = "";
$passErrors = "";
$enterThePassErrors = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST["ten"];
    $pass = $_POST["pass"];
    $enterThePass = $_POST["enterThePass"];
    if (empty($ten)) {
        $tenErrors = "Tên tài khoản là bắt buộc";
    }
    if (empty($pass)) {
        $passErrors = "Mật khẩu là bắt buộc";
    }
    if (empty($enterThePass)) {
        $enterThePassErrors = "Nhập lại mật khẩu là bắt buộc";
    }
    if ($pass != $enterThePass) {
        $enterThePassErrors = "Nhập lại mật khẩu không đúng";
    }
    if ($tenErrors == "" && $passErrors == "" && $enterThePassErrors == "") {
        if (!Auth::add($ten, $pass)) {
            $noti = "Tên tài khoản đã tồn tại";
        } else {
            header("Location:index.php");
        }
    }
}
?>
<?php include "inc/header.php" ?>
<h1 class="text-center mt-2">ĐĂNG KÝ TÀI KHOẢN</h1>
<form method="post" class="w-50 m-auto">
    <div class="mb-3">
        <label for="ten" class="form-label"><b>UserName</b></label>
        <input type="text" class="form-control" id="ten" name="ten" placeholder="Enter your name" /><span class='text-danger'><?= $tenErrors ?></span>
    </div>

    <div class="mb-3">
        <label for="pass" class="form-label"><b>Password</b></label>
        <input type="password" class="form-control" id="pass" name="pass" placeholder="••••••••••••••••••" /><span class='text-danger'><?= $passErrors ?></span>
    </div>

    <div class="mb-3">
        <label for="enterThePass" class="form-label"><b>Enter the password</b></label>
        <input type="password" class="form-control" id="enterThePass" name="enterThePass" placeholder="••••••••••••••" /><span class='text-danger'><?= $enterThePassErrors ?></span>
    </div>

    <div class="text-center pt-2">
        <button type="submit" class="btn btn-danger">ĐĂNG KÝ</button>
    </div>

    <div class="text-center p-2">
        <span class="text-danger"><?= $noti ?></span>
    </div>
</form>
<?php include "inc/footer.php" ?>