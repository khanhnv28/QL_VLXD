<?php
    if(!isset($_SESSION['log_detail'])){
        header('location: ../index.php');
    }elseif($_SESSION['log_detail'] !='admin'){
        header('location: ../index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta mame="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
     integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Đồ Án</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <a href="index.php">
                    <img width="415" height="120" src="../Images/logo.jpg" />
                </a>
            </div>
            <div class="col-5">
                <form class="form-inline ml-5 mt-4 pl-3" method="get" action="index.php">
                    <input class="w-50 ml-2 pl-2" style="height:50px" type="text" name="search" placeholder="Nhập sản phẩm cần tìm" />
                    <button style="height:50px; width:50px" class="border-left-0 bg-danger">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row bg-danger">
            <div class="container-fluid pl-4 pr-4">
                <ul class="nav navbar ">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-center text-white"><i class="fa-solid fa-house"></i><br />TRANG CHỦ</a>
                    </li>
                    <?php if (!isset($_SESSION['log_detail'])) : ?>
                        <li class="nav-item">
                            <a href="register.php" class="nav-link text-center text-white"><i class="fa-brands fa-microsoft"></i><br />ĐĂNG KÝ</a>
                        </li>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link text-center text-white"><i class="fa-thin fa-user"></i><br />ĐĂNG NHẬP</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link text-center text-white"><i class="fa-solid fa-trowel-bricks"></i><br />ĐĂNG XUẤT</a>
                        </li>
                        <?php if ($_SESSION['log_detail'] == "admin") : ?>
                            <li class="nav-item">
                                <a href="new-product.php" class="nav-link text-center text-white"><i class="fa-solid fa-paint-roller"></i><br />THÊM SẢN PHẨM MỚI</a>
                            </li>
                        <?php endif; ?>
                     <?php endif; ?>
                    <li class="nav-item">
                        <a href="user.php" class="nav-link text-center text-white"><i class="fa-solid fa-bath"></i><br />QUẢN LÍ TÀI KHOẢN</a>
                    </li>
                    <li class="nav-item">
                        <a href="user-new.php" class="nav-link text-center text-white"><i class="fa-solid fa-layer-group"></i><br />THÊM TÀI KHOẢN MỚI</a>
                    </li>
                    <li class="nav-item">
                        <a href="manage-order.php" class="nav-link text-center text-white"><i class="fa-solid fa-plug-circle-plus"></i><br />QUẢN LÝ ĐƠN HÀNG</a>
                    </li>              
                </ul>
            </div>
        </div>