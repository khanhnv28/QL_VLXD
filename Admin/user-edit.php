<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require '../inc/init.php';
$taikhoan = $_GET["taikhoan"];
$db = new Database();
$pdo = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new Users();
    $user->username= $taikhoan;
    $user->password= $_POST['password'];
    if($user->updateUser($pdo)){
         header("Location:user.php");
    }
 }
 if(!Users::kiemTraUser($pdo, $taikhoan)){
    echo("Tài khoản không hợp lệ!!!!!");
}
?>
<?php include 'inc/header.php' ?>
<div class="col mt-2">
    <h3 class="text-center">ĐỔI MẬT KHẨU <?= $taikhoan ?></h3>
    <form class="w-50 m-auto" method="post">
        <div>
            <label for="password" class="form-label"><b>Mật khẩu vừa đổi (<span class="text-danger">*</span>)</b></label>
            <input class="form-control" type="password" id="password" name="password" require>
        </div>
        <div class="text-center mt-2">
            <button class="btn btn-danger" type="submit">SỬA</button>
        </div>
    </form>
</div>
<?php include 'inc/footer.php' ?>