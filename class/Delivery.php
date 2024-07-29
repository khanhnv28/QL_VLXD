<?php
    class Delivery{
        public $ngaylapdonhang;
        public $magiohang;
        public $sodienthoai;
        public $diachi;
        public $tinhtrang;

        public function add($pdo){    
        $sql = "INSERT INTO vanchuyen VALUES (NOW(), :magiohang, :diachi, :tinhtrang, :sodienthoai)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':magiohang', $this->magiohang, PDO::PARAM_INT);
        $stmt->bindParam(':diachi', $this->diachi, PDO::PARAM_STR);
        $stmt->bindParam(':tinhtrang', $this->tinhtrang, PDO::PARAM_BOOL);
        $stmt->bindParam(':sodienthoai', $this->sodienthoai, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE vanchuyen SET tinhtrang=:tinhtrang WHERE magiohang = :magiohang";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':tinhtrang', $this->tinhtrang, PDO::PARAM_BOOL);
        $stmt->bindValue(':magiohang', $this->magiohang, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM vanchuyen, giohang WHERE vanchuyen.magiohang = giohang.magiohang ORDER BY ngaylapdonhang DESC";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Delivery');
            return $stmt->fetchAll();
        }
    }
}
?>