<?php
class Cart
{
    public $magiohang;
    public $username;
    public $thanhtoan;
    public $tinhtrang;


    public static function maGioHang($pdo, $username, $thanhtoan)
    {
        $sql = "SELECT magiohang FROM giohang WHERE username = :username AND thanhtoan = :thanhtoan";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':thanhtoan', $thanhtoan, PDO::PARAM_BOOL);

        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }

    public function add($pdo)
    {    
        $sql = "INSERT INTO giohang(username, thanhtoan) VALUES (:username, :thanhtoan)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':thanhtoan', $this->thanhtoan, PDO::PARAM_BOOL);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE giohang SET thanhtoan=:thanhtoan WHERE magiohang = :magiohang AND username = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':thanhtoan', $this->thanhtoan, PDO::PARAM_BOOL);
        $stmt->bindValue(':magiohang', $this->magiohang, PDO::PARAM_INT);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public static function getOneByID($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM vanchuyen WHERE magiohang = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(self::class);
    }

    // Phương thức cập nhật trạng thái đơn hàng
    public function updateStatus($pdo, $tinhtrang) {
        $stmt = $pdo->prepare("UPDATE vanchuyen SET tinhtrang = :tinhtrang WHERE magiohang = :id");
        return $stmt->execute(['tinhtrang' => $tinhtrang, 'id' => $this->magiohang]);
    }

}
