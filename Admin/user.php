<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "../inc/init.php";

$db = new Database();
$pdo = $db->connect();
$User = Users::getAllUser($pdo);
?>
<?php require 'inc/header.php'; ?>
<div class="col p-2">
   <h3 class="text-center">QUẢN LÝ NGƯỜI DÙNG</h3>
   <div class="m-auto w-50">
    <table class="mt-3 table table-striped table-bordered text-center">
        <tr>
            <th>TÀI KHOẢN</th>
            <th>HÀNH ĐỘNG</th>
        </tr>
        <?php foreach($User as $row) :?>
            <tr>
                <td><b><?= $row->username ?></b></td>
                <td><a class="text-decoration-none text-black" href="user-edit.php?taikhoan=<?= $row->username ?>"> <b>Sửa mật khẩu</b></a>
                        <?php if($row->username != "admin") : ?> | 
                            <a class="text-decoration-none text-black" href="user-delete.php?taikhoan=<?= $row->username ?>"><b>Xóa tài khoản </b></a><?php endif; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
   </div>
</div>
<?php require 'inc/footer.php'; ?>