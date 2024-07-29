<?php
// Tự động tải các lớp
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});

// Khởi tạo và kết nối cơ sở dữ liệu
require '../inc/init.php';
$db = new Database();
$pdo = $db->connect();

// Xử lý yêu cầu POST để cập nhật trạng thái đơn hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $magiohang = $_POST['magiohang'];
    $tinhtrang = $_POST['tinhtrang'];

    // Lấy thông tin giỏ hàng hiện tại
    $cart = Cart::getOneByID($pdo, $magiohang);

    // Cập nhật trạng thái đơn hàng
    if ($cart && $cart->updateStatus($pdo, $tinhtrang)) {
        echo "Trạng thái đơn hàng đã được cập nhật.";
    } else {
        echo "Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.";
    }

    // Chuyển hướng quay lại trang trước
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<?php require 'inc/header.php'; ?>

<!-- Nội dung trang (có thể thêm thông báo nếu cần) -->

<?php require 'inc/footer.php'; ?>
