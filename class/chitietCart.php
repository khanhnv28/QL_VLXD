<?php
class chitietCart
{
    public $magiohang;
    public $mahanghoa;
    public $soluong;

    public static function getAll($pdo, $magiohang)
    {
        $sql = "SELECT * FROM hanghoa, chitietgiohang WHERE magiohang = :magiohang  AND chitietgiohang.mahanghoa=hanghoa.mahanghoa";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':magiohang', $magiohang, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'chitietCart');
            return $stmt->fetchAll();
        }
    }

    public static function soLuong($pdo, $magiohang, $mahanghoa)
    {
        $sql = "SELECT soluong FROM chitietgiohang WHERE magiohang = :magiohang AND mahanghoa = :mahanghoa";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':magiohang', $magiohang, PDO::PARAM_INT);
        $stmt->bindValue(':mahanghoa', $mahanghoa, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }

    public static function soLuongHangHoa($pdo, $magiohang)
    {
        $sql = "SELECT COUNT(*) FROM chitietgiohang WHERE magiohang = :magiohang";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':magiohang', $magiohang, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }

    public function add($pdo)
    {
        $sql = "INSERT INTO chitietgiohang(magiohang, mahanghoa, soluong) VALUES (:magiohang, :mahanghoa, :soluong)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':magiohang', $this->magiohang, PDO::PARAM_INT);
        $stmt->bindValue(':mahanghoa', $this->mahanghoa, PDO::PARAM_INT);
        $stmt->bindValue(':soluong', $this->soluong, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($pdo)
    {
        $sql = "DELETE FROM chitietgiohang WHERE magiohang = :magiohang AND mahanghoa = :mahanghoa";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':magiohang', $this->magiohang, PDO::PARAM_INT);
        $stmt->bindValue(":mahanghoa", $this->mahanghoa, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function empty($pdo)
    {
        $sql = "DELETE FROM chitietgiohang WHERE magiohang= :magiohang";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':magiohang', $this->magiohang, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE chitietgiohang SET soluong=:soluong WHERE magiohang = :magiohang AND mahanghoa = :mahanghoa";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':magiohang', $this->magiohang, PDO::PARAM_INT);
        $stmt->bindValue(':mahanghoa', $this->mahanghoa, PDO::PARAM_INT);
        $stmt->bindValue(':soluong', $this->soluong, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
