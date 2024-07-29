<?php
if (!isset($_GET["mahanghoa"])) {
    die("Cần cung cấp mã hàng hóa sản phẩm");
}

$mahanghoa = $_GET["mahanghoa"];

spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "inc/init.php";

$db = new Database();
$pdo = $db->connect();
$product = Product::getOneByID($pdo, $mahanghoa);

if (!$product) {
    die("Mã hàng hóa không hợp lệ");
}
?>
<?php require 'inc/header.php'; ?>
<div class="row p-2">
    <div class="col-5">
         <img class="w-100" src="../Images/<?= $product->hinh ?>">
    </div>
    <div class="col-7">
        <h1 class="text-center"><?= $product->tenhanghoa ?></h1>
        <p>Giá: <b class="text-danger"><?= number_format($product->gia, 0, ',', '.') ?> đ</b></p>
        <p>Địa chỉ: <?= $product->diachi ?></p>
        <p>Xuất xứ: <?= $product->xuatxu ?></p>
        <p>Mô tả: <?= $product->mota ?></p>
        <?php if (isset($_SESSION['log_detail'])) : ?>
            <?php if ($_SESSION['log_detail'] == "admin") : ?>
                <div class="text-center">
                    <a href="edit-product.php?mahanghoa=<?= $product->mahanghoa ?>" class="btn btn-warning">CẬP NHẬT</a>
                    <a href="delete-product.php?mahanghoa=<?= $product->mahanghoa ?>" class="btn btn-danger">XÓA</a>
                </div>
            <?php endif; ?>
        <?php endif; ?> 
    </div>
</div>
<?php require 'inc/footer.php'; ?>