<?php
$id = $_GET["mahanghoa"];

spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require '../inc/init.php';

$db = new Database();
$pdo = $db->connect();
$product = Product::getOneByID($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if($product->deleteHangHoa($pdo)) {
        $hinh = '../Images/' . $product->hinh;
        unlink($hinh);
    }
    header("Location:../index.php");
}
?>
<?php require 'inc/header.php'; ?>
<form method="post" class="m-auto">
    <div class="text-center">
        <h2>Bạn có muốn xóa <?= $product->tenhanghoa ?> không???</h2>
        <button type="submit" class="btn btn-danger">CÓ</button>
        <a href="product.php?mahanghoa=<?= $product->mahanghoa ?>" class="btn btn-primary">KHÔNG</a>
    </div>
</form>
<?php require 'inc/footer.php'; ?>