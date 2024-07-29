<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "../inc/init.php";
$db = new Database();
$pdo = $db->connect();

$noti = "";
$ten = "";
$pass = "";

$tenErrors = "";
$passErrors = "";

$user = new Users();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST["ten"];
    $pass = $_POST["pass"];
    $user->username=$ten;
    $user->password=$pass;
    if (empty($ten)) {
        $tenErrors = "Tên tài khoản là bắt buộc";
    }
    if (empty($pass)) {
        $passErrors = "Mật khẩu là bắt buộc";
    }

    if (!$user->addUser($pdo)) {
            $noti = "Tên tài khoản đã tồn tại";
        } else {
            header("Location:user.php");
        }
}
?>
<?php include "inc/header.php" ?>
<h1 class="text-center mt-2">TÀI KHOẢN MỚI</h1>
<form method="post" class="w-50 m-auto">
    <div class="mb-3">
        <label for="ten" class="form-label"><b>UserName (<span class="text-danger">*</span>)</b></label>
        <input type="text" class="form-control" id="ten" name="ten" placeholder="Enter your name" /><span class='text-danger'><?= $tenErrors ?></span>
    </div>

    <div class="mb-3">
        <label for="pass" class="form-label"><b>Password (<span class="text-danger">*</span>)</b></label>
        <input type="password" class="form-control" id="pass" name="pass" placeholder="••••••••••••••••••" /><span class='text-danger'><?= $passErrors ?></span>
    </div>

    <div class="text-center pt-2">
        <button type="submit" class="btn btn-danger">THÊM</button>
    </div>

    <div class="text-center p-2">
        <span class="text-danger"><?= $noti ?></span>
    </div>
</form>
<?php include "inc/footer.php" ?>