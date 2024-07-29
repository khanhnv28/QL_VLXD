<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require '../inc/init.php';

$db = new Database();
$pdo = $db->connect();
$dataCat = ProductLoai::getAll($pdo);

$maloai="";
$tenhanghoa = "";
$mota = "";
$soluong = "";
$gia = "";
$diachi = "";
$xuatxu = "";
$hinh = "";

$maloaiErrors="";
$tenhanghoaErrors = "";
$motaErrors = "";
$soluongcErrors = "";
$giaErrors = "";
$diachiErrors = "";
$xuatxuErrors = "";
$hinhErrors = "";

$noti = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maloai = $_POST['maloai'];
    $tenhanghoa = $_POST['tenhh'];
    $mota = $_POST['mota'];
    $soluong = $_POST['soluong'];
    $gia = $_POST['gia'];
    $diachi = $_POST['diachi'];
    $xuatxu = $_POST['xuatxu'];

    if (empty($tenhanghoa)) {
        $tenhanghoaErrors = "Vui lòng nhập tên hàng hóa";
    }

    if (empty($mota)) {
        $motaErrors = "Vui lòng nhập mô tả";
    }

    if (empty($soluong)) {
        $soluongcErrors = "Vui lòng nhập số lượng";
    } elseif ($soluong < 0 ) {
        $soluongcErrors = "Số lượng không hợp lệ!";
    }

    if (empty($gia)) {
        $giaErrors = "Vui lòng nhập giá";
    } elseif ($gia % 1000 != 0) {
        $giaErrors = "Giá không hợp lệ!!";
    }

    if (empty($diachi)) {
        $diachiErrors = "Vui lòng nhập địa chỉ";
    }

    if (empty($xuatxu)) {
        $xuatxuErrors = "Vui lòng nhập xuất xứ";
    }

    if (empty($hinh)) {
        $hinhErrors = "Vui lòng chọn hình";
    }
    try {
        if (empty($_FILES['hinh'])) {
            throw new Exception('Invalid upload');
        }

        switch ($_FILES['hinh']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded');
            default:
                throw new Exception('An error occured');
        }

        if ($_FILES['hinh']['size'] > 1000000) {
            throw new Exception('File too large');
        }

        $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($file_info, $_FILES['hinh']['tmp_name']);
        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type');
        }

        $pathinfo = pathinfo($_FILES['hinh']['name']);
        $fname = 'Images';
        $extension = $pathinfo['extension'];

        $file = $fname . '.' . $extension;
        $dest = '../Images/' . $file;
        $i = 1;
        while (file_exists($dest)) {
            $file = $fname . "-$i." . $extension;
            $dest = '../Images/' . $file;
            $i++;
        }

        if (move_uploaded_file($_FILES['hinh']['tmp_name'], $dest)) {
        } else {
            throw new Exception('Unable to move file.');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    if ($tenhanghoaErrors == "" && $motaErrors == "" && $soluongcErrors == "" && $giaErrors == "" && $diachiErrors == "" && $xuatxuErrors == "") {
        $product = new Product();
        $product->maloai = $maloai;
        $product->tenhanghoa = $tenhanghoa;
        $product->mota = $mota;
        $product->soluong = $soluong;
        $product->gia = $gia;
        $product->diachi = $diachi;
        $product->xuatxu = $xuatxu;
        $product->hinh = $file;
        if ($product->addhangHoa($pdo)) {
            header("Location: product.php?mahanghoa={$product->mahanghoa}");
            exit;
        }
    }
}
?>
<?php include 'inc/header.php' ?>

<h2 class="text-center" >THÊM HÀNG HÓA MỚI</h2>
<form method="post" enctype='multipart/form-data' class="w-50 m-auto">
    <div class="mb-3">
        <label for="tenhh" class="form-label">Tên Hàng Hóa (<span class="text-danger">*</span>)</label>
        <input class="form-control" id="tenhh" name="tenhh" value="<?= $tenhanghoa ?>" /><span class='text-danger'><?= $tenhanghoaErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="mota" class="form-label">Mô Tả (<span class="text-danger">*</span>)</label>
        <textarea class="form-control" id="mota" name="mota" rows="4"><?= $mota ?></textarea><span class='text-danger'><?= $motaErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="soluong" class="form-label">Số Lượng (<span class="text-danger">*</span>)</label>
        <input class="form-control" id="soluong" name="soluong" type="number" min="0" value="<?= $soluong ?>" /><span class='text-danger'><?= $soluongcErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="gia" class="form-label">Giá (<span class="text-danger">*</span>)</label>
        <input class="form-control" id="gia" name="gia" type="number" min="0" value="<?= $gia ?>" /><span class='text-danger'><?= $giaErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="diachi" class="form-label">Địa Chỉ (<span class="text-danger">*</span>)</label>
        <textarea class="form-control" id="diachi" name="diachi" rows="4"><?= $diachi ?></textarea><span class='text-danger'><?= $diachiErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="xuatxu" class="form-label">Xuất Xứ(<span class="text-danger">*</span>)</label>
        <textarea class="form-control" id="xuatxu" name="xuatxu" rows="4"><?= $xuatxu ?></textarea><span class='text-danger'><?= $xuatxuErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="hinh" class="form-label">Hình Hàng Hóa (<span class="text-danger">*</span>)</label>
        <input class="form-control" type="file" name="hinh" id="hinh" />
    </div>
    <div class="mb-3">
        <label class="form-label"><b>Loại Hàng Hóa</b></label>
        <?php foreach ($dataCat as $row) : ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="maloai" value="<?= $row->maloai ?>" id="<?= $row->maloai ?>">
                <label class="form-check-label" for="<?= $row->maloai ?>"><?= $row->tenloai ?></label>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="submit" class="btn btn-primary form-control">THÊM</button>
    <span class="text-success"><?= $noti ?></span>
</form>
<?php include 'inc/footer.php' ?>