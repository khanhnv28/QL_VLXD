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
   if($user->deleteUser($pdo)){
        header("Location:user.php");
   }
}
if($taikhoan == "admin"){
    header("Location:user.php");
}

if(!Users::kiemTraUser($pdo, $taikhoan)){
    echo("Tài khoản không hợp lệ!!!!!");
}
?>
<?php require 'inc/header.php'; ?>
<form method="post" class="m-auto">
    <div class="text-center">
        <h2>Bạn có muốn xóa <?= $taikhoan ?> không???</h2>
        <button type="submit" class="btn btn-danger">CÓ</button>
        <a href="user.php" class="btn btn-primary">KHÔNG</a>
    </div>
</form>
<?php require 'inc/footer.php'; ?>