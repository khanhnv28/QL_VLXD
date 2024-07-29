<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require "inc/init.php";

$db = new Database();
$pdo = $db->connect();

$product_per_page = 8;
$limit = $product_per_page;
#------Phan Trang-----------
$page = $_GET['page'] ?? 1;
$page = $page < 1 ? 1 : $page;
$max = Product::getCount($pdo, $limit);
$page = $page > $max ? $max : $page;
$offset = ($page - 1) * $product_per_page;
#----------------------------
$data = Product::getPage($pdo, $limit, $offset);
$dataloaihang = ProductLoai::getAll($pdo);
#-----------Sap xep, Tim kiem Loai hang-------------
if(isset($_GET['cate']) && isset($_GET['arr'])){
    $sx= $_GET['arr'];
    $data= Product::getPageSortLoai($pdo, $limit, $offset, $_GET['cate'], $sx);
    $m= Product::getCountLoai($pdo, $limit, $_GET['cate']);
} else if (isset($_GET['cate'])){
    $data= Product::getPageSortLoai($pdo, $limit, $offset, $_GET['cate']);
    $m= Product::getCountLoai($pdo, $limit, $_GET['cate']);
} else if (isset($_GET['arr'])){
    $sx= $_GET['arr'];
    $data= Product::getPageSort($pdo, $limit, $offset, $sx);
    $m= Product::getCount($pdo, $limit);
} else if (isset($_GET['search']) && !empty($_GET['search'])){
    $data= Product::getPageSearch($pdo, $limit, $offset, $_GET['search']);
    $m= Product::getSearch($pdo, $limit, $_GET['search']);
}
#---------------------------------
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
<?php include "inc/header.php" ?>
<div class="row">
    <div class="col-9">
        <div class="row p-2">
            <?php foreach ($data as $row) : ?>
                <div class="col-3 mt-3">
                    <div class="card" style="height: 100%;">
                        <a href="product.php?mahanghoa=<?= $row->mahanghoa ?>"><img class="card-img-top" style="height: 16rem" src="Images/<?= $row->hinh?>"></a>
                        <div class="card-body text-center">
                            <a href="product.php?mahanghoa=<?= $row->mahanghoa ?>" class="card-title h5 text-dark text-decoration-none"> <?= $row->tenhanghoa ?></a><br>
                            <b class="card-text text-danger font-weight-bold"><?= number_format($row->gia, 0, ',', '.') ?> VNĐ</b><br>
                            <?php if (isset($_SESSION['log_detail'])) : ?>
                                <a href="index.php?action=addcart&mahanghoa=<?= $row->mahanghoa ?>" style="border-radius:20px" class="btn btn-block btn-outline-danger text-white bg-danger"><i class="fa-brands fa-opencart"></i> MUA HÀNG</a>      
                            <?php endif; ?>          
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-3 mt-3">
        <ul class="nav flex-column">
            <li class="text-white bg-danger text-center"><h2>VẬT LIỆU XÂY DỰNG</h2></li>
            <?php foreach ($dataloaihang as $loaihang) : ?>
                <li class="nav-item">
                    <a class="text-primary nav-link border-bottom" href="index.php?cate=<?= $loaihang->maloai ?>"><?= $loaihang->tenloai ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post" class="m-auto mt-3 rounded border p-3">
            <h3>Sắp Xếp</h3>
            <div>
                <input type="radio" id="ascending" name="arrange" <?php if (isset($_GET['arr']) && $_GET['arr']=="gia ASC") : ?> checked <?php endif ?> onclick="location.href='index.php?<?php if (isset($_GET['cate'])) : ?>$cate=<?= $_GET['cate'] ?>&<?php endif; ?>arr= gia ASC'">
                <label for="ascending">Tăng Dần</label><br>
                <input type="radio" id="descending" name="arrange" value="DESC" <?php if (isset($_GET['arr']) && $_GET['arr']=="gia DESC") : ?> checked <?php endif ?> onclick="location.href='index.php?<?php if (isset($_GET['cate'])) : ?>$cate=<?= $_GET['cate'] ?>&<?php endif; ?>arr= gia DESC'">
                <label for="descending">Giảm Dần</label>
            </div>
        </form>
    </div>
</div>
<div class="row mt-3">
    <div class="text-center col">
        <?php if ($page != 1) : ?>
            <a class="btn btn-secondary" href="index.php?page=<?= $page - 1 ?>
            <?php if (isset($_GET['cate'])) : ?>$cate=<?= $_GET['cate'] ?><?php endif; ?>
                
                <?php if (isset($_GET['arr'])) : ?>$arr=<?= $_GET['arr'] ?><?php endif; ?>">‹</a>&nbsp;
        <?php endif; ?>
        <?php for ($i = 1; $i <= $max; $i++) : ?>
            <a class="btn btn-secondary" href="index.php?page=<?= $i ?>
            <?php if (isset($_GET['cate'])) : ?>$cate=<?= $_GET['cate'] ?><?php endif; ?>"><?= $i ?></a>&nbsp;
        <?php endfor; ?>
        <?php if ($page != $max) : ?>
            <a class="btn btn-secondary" href="index.php?page=<?= $page + 1 ?>
            <?php if (isset($_GET['cate'])) : ?>$cate=<?= $_GET['cate'] ?><?php endif; ?>
                <?php if (isset($_GET['arr'])) : ?>$arr=<?= $_GET['arr'] ?><?php endif; ?>">›</a>&nbsp;
        <?php endif; ?>
    </div>
</div>
<?php include "inc/footer.php" ?>