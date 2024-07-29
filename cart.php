<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require 'inc/init.php';

$db = new Database();
$pdo = $db->connect();
$magiohang = Cart::maGioHang($pdo, $_SESSION['log_detail'], false);
$taikhoan = $_SESSION['log_detail'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c = new chitietCart();
    $c->magiohang = $magiohang;
    $c->mahanghoa = $_POST['mahanghoa'];
    $c->soluong = $_POST['soluong'];
    $c->update($pdo);
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'empty') {
        $c = new chitietCart();
        $c->magiohang = $magiohang;
        $c->empty($pdo);
    }

    if ($action == 'remove') {
        if (isset($_GET['mahanghoa'])) {
            $c = new chitietCart();
            $c->magiohang = $magiohang;
            $c->mahanghoa = $_GET['mahanghoa'];
            $c->delete($pdo);
        }
    }
}
?>

<?php require 'inc/header.php'; ?>
<div class="container">
    <?php if ($magiohang){
        if($ctgt = chitietCart::getAll($pdo, $magiohang)) { ?>
        <h1 class="text-center mt-2">GIỎ HÀNG</h1>
        <div class="row">
            <div class="col-10">
                <a href="cart.php?action=empty" class="btn btn-danger mt-2">Xóa Giỏ Hàng</a>
            </div>
            <div class="col-2 mr-5">
                <a href="index.php" class=" text-decoration-none text-primary mt-2">< Mua thêm hàng hóa</a>
            </div>
        </div>  
        <table class="table align-middle bg-light">       
            <thead>
                <tr class="text-center text-white bg-secondary">
                    <th>STT</th>
                    <th>Hình</th>
                    <th>Tên hàng hóa</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Hàng động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($magiohang){
                    if($ctgt = chitietCart::getAll($pdo, $magiohang)){
                        $i = 1;
                        $total = 0;
                        foreach ($ctgt as $cart) : ?>
                            <tr class="text-center">
                                <form method="post">
                                    <td><?= $i ?></td>
                                    <td class="w-25"><img style="height: 14rem" class="w-100" src="Images/<?= $cart->hinh ?>"></td>
                                    <td><?= $cart->tenhanghoa ?></td>
                                    <td><?= number_format($cart->gia, 0, ',', '.') ?> VNĐ</td>
                                    <td>
                                        <input type="number" value="<?= $cart->soluong ?>" name="soluong" min="1" style="width: 50px" />
                                        <input type="hidden" name="mahanghoa" value="<?= $cart->mahanghoa ?>" />
                                    </td>
                                    <td>
                                        <input type="submit" name="update" value="Cập nhật" class="btn btn-primary" />
                                        <a href="cart.php?action=remove&mahanghoa=<?= $cart->mahanghoa ?>" class="btn btn-warning">Xóa</a>
                                    </td>
                                </form>
                            </tr>
                            <?php
                                $i++;
                                $total += $cart->gia * $cart->soluong;
                                endforeach; 
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <h4 class="text-danger text-center">TỔNG TIỀN: <?= number_format($total, 0, ',', '.') ?> VNĐ</h4>
                                    <h4 class="text-danger text-center"><a href="pay.php" class="btn btn-danger mt-2">THANH TOÁN</a></h4>
                                </td>
                            </tr>
                <?php }} ?>
            </tbody>
        </table>
    <?php } else { ?>
        <h1 class="text-center mt-3">GIỎ HÀNG RỖNG</h1>
    <?php }
    } else { ?>
     <h1 class="text-center mt-3">GIỎ HÀNG RỖNG</h1>
     <?php } ?>
</div>

<?php require 'inc/footer.php'; ?>