<?php
if (!isset($_GET["mahanghoa"])) {
    die("Cần cung cấp mã hàng hóa sản phẩm");
}

$mahanghoa = $_GET["mahanghoa"];

spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require "inc/init.php";

$db = new Database();
$pdo = $db->connect();
$product = Product::getOneByID($pdo, $mahanghoa);

if (!$product) {
    die("Mã hàng hóa không hợp lệ");
}

if (isset($_GET['action']) && isset($_GET['mahanghoa'])) {
    $action = $_GET['action'];
    $mahanghoa = $_GET['mahanghoa'];
    if ($action == 'addcart') {
        $taikhoan = $_SESSION['log_detail'];
        if(!$magiohang = Cart::maGioHang($pdo, $taikhoan, false)){
            $giohang = new Cart();
            $giohang->username = $taikhoan;
            $giohang->thanhtoan = false;
            // $giohang->tinhtrang = false;
            if($giohang->add($pdo)){
                $chitiet = new chitietCart();
                $chitiet->magiohang = $giohang->magiohang;
                $chitiet->mahanghoa = $mahanghoa;
                $chitiet->soluong = 1;
                $chitiet->add($pdo);
            }
        }else {
            if(!$soluong = chitietCart::soluong($pdo, $magiohang, $mahanghoa)){
                $chitiet = new chitietCart();
                $chitiet->magiohang = $magiohang;
                $chitiet->mahanghoa = $mahanghoa;
                $chitiet->soluong = 1;
                $chitiet->add($pdo);
            }else {
                $chitiet = new chitietCart();
                $chitiet->magiohang = $magiohang;
                $chitiet->mahanghoa = $mahanghoa;
                $chitiet->soluong = $soluong + 1;
                $chitiet->update($pdo);
            }
        }
    }
}
?>
<?php require 'inc/header.php'; ?>
<div class="row p-2">
    <div class="col-5">
         <img class="w-100" src="Images/<?= $product->hinh ?>">
    </div>
    <div class="col-7">
        <h1 class="text-center"><?= $product->tenhanghoa ?></h1>
        <p>Giá: <b class="text-danger"><?= number_format($product->gia, 0, ',', '.') ?> đ</b></p>
        <p>Địa chỉ: <?= $product->diachi ?></p>
        <p>Xuất xứ: <?= $product->xuatxu ?></p>
        <p>Mô tả: <?= $product->mota ?></p>
        <?php if (isset($_SESSION['log_detail'])) : ?>
          <div style="border-radius:20px"><a href="index.php?action=addcart&mahanghoa=<?= $product->mahanghoa ?>" class="btn btn-block btn-outline-danger bg-danger text-white"><i class="fa-brands fa-opencart"></i> MUA HÀNG</a></div>
        <?php endif; ?>    
    </div>
</div>
<?php require 'inc/footer.php'; ?>