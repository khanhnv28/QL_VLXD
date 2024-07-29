<?php
class ProductLoai
{
    public $maloai;
    public $tenloai;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM loaihang";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ProductLoai');
            return $stmt->fetchAll();
        }
    }
}
?>