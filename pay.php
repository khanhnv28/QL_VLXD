<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require 'inc/init.php';

$db = new Database();
$pdo = $db->connect();
$username = $_SESSION['log_detail'];
if($magiohang = Cart::maGioHang($pdo, $username, false)){
    if($ctgh = chitietCart::getAll($pdo, $magiohang)){
        $tong = 0;
        $tongsoluong = 0;
        foreach($ctgh as $cart){
            $tongsoluong += $cart->soluong;
            $tong += $cart->gia * $cart->soluong;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c = new Cart();
    $c->magiohang = $magiohang;
    $c->username= $username;
    $c->thanhtoan = true;
    if($c->update($pdo)){
        $vanchuyen = new Delivery();
        $vanchuyen->magiohang = $magiohang;
        $vanchuyen->diachi= $_POST['diachi'];
        $vanchuyen->tinhtrang = true;
        $vanchuyen->sodienthoai= $_POST['sodienthoai'];
        if($vanchuyen->add($pdo)){
            header("Location:index.php");
        }
    }
}
?>
<?php require 'inc/header.php'; ?>
<div class="mt-5 col">
    <h2 class="text-center" >THÔNG TIN ĐƠN HÀNG</h2>
    <form method="post" enctype='multipart/form-data' class="w-25 m-auto">
        <div class="mb-3">
            <label class="form-label "><b>Tổng số lượng</b></label>
            <input class="form-control" type="number" value="<?= $tongsoluong ?>" disabled />
        </div>
         <div class="mb-3">
            <label for="sodienthoai" class="form-label"><b>Số điện thoại (<span class="text-danger">*</span>)</b></label>
            <input class="form-control" maxlength="10" pattern="[0-9]{10}" type="tel" id="sodienthoai" name="sodienthoai" required/>
        </div>
        <div class="mb-3">
            <label for="diachi" class="form-label"><b>Địa chỉ (<span class="text-danger">*</span>)</b></label>
            <input class="form-control" id="diachi" type="text" name="diachi" required/>
        </div>
        <div class="mb-3">
            <label class="form-label"><b>Tổng tiền</b></label>
            <input class="form-control" type="number" value="<?= $tong ?>" disabled />
        </div>
        <button type="submit" class="btn btn-primary form-control"><b>THANH TOÁN</b></button>
    </form>
</div>
<?php require 'inc/footer.php'; ?>