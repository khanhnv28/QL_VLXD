<?php
class Product
{
    public $mahanghoa;
    public $maloai;
    public $tenhanghoa;
    public $mota;
    public $soluong;
    public $gia;
    public $diachi;
    public $xuatxu;
    public $hinh;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM hanghoa";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getCount($pdo, $limit)
    {
        $sql = "SELECT COUNT(*) FROM hanghoa";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            return ceil($stmt->fetchColumn() / $limit);
        }
    }

    public static function getPage($pdo, $limit, $offset)
    {
        $sql = "SELECT * FROM hanghoa ORDER by mahanghoa DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }
    
    public static function getOneByID($pdo, $mahanghoa)
    {
        $sql = "SELECT * FROM hanghoa WHERE mahanghoa = :mahanghoa";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':mahanghoa', $mahanghoa, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetch();
        }
    }

    public static function getCountLoai($pdo, $limit, $maloai)
    {
        $sql = "SELECT COUNT(*) FROM hanghoa WHERE maloai = :maloai";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':maloai', $maloai, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return ceil($stmt->fetchColumn() / $limit);
        }
    }

    public static function getPageLoai($pdo, $limit, $offset, $maloai)
    {
        $sql = "SELECT * FROM hanghoa WHERE maloai = :maloai ORDER BY mahanghoa DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':maloai', $maloai, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }
    public static function getPageSort($pdo, $limit, $offset, $sort="mahanghoa DESC")
    {
        $sql = "SELECT * FROM hanghoa ORDER by " . $sort . " LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }
    public static function getPageSortLoai($pdo, $limit, $offset, $maloai, $sort="mahanghoa DESC")
    {
        $sql = "SELECT * FROM hanghoa WHERE maloai = :maloai ORDER BY " . $sort . " LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':maloai', $maloai, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getPageSearch($pdo, $limit, $offset, $search)
    {
        $search = "%". $search . "%";
        $sql = "SELECT * FROM hanghoa WHERE mahanghoa LIKE :search OR tenhanghoa LIKE :search OR mota LIKE :search ORDER BY mahanghoa LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', $search, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getSearch($pdo, $limit, $search)
    {
        $search = "%". $search . "%";
        $sql = "SELECT COUNT(*) FROM hanghoa WHERE mahanghoa LIKE :search OR tenhanghoa LIKE :search OR mota LIKE :search";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':search', $search, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchColumn()/$limit;
        }
    }

    public function addhangHoa($pdo)
    {
        $sql = "INSERT INTO hanghoa(maloai, tenhanghoa, mota, soluong, gia, diachi, xuatxu, hinh) VALUES (:maloai, :tenhanghoa, :mota, :soluong, :gia, :diachi, :xuatxu, :hinh)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':maloai', $this->maloai, PDO::PARAM_INT);
        $stmt->bindParam(':tenhanghoa', $this->tenhanghoa, PDO::PARAM_STR);
        $stmt->bindParam(':mota', $this->mota, PDO::PARAM_STR);
        $stmt->bindParam(':soluong', $this->soluong, PDO::PARAM_INT);
        $stmt->bindParam(':gia', $this->gia, PDO::PARAM_INT);
        $stmt->bindParam(':diachi', $this->diachi, PDO::PARAM_STR);
        $stmt->bindParam(':xuatxu', $this->xuatxu, PDO::PARAM_STR);
        $stmt->bindParam(':hinh', $this->hinh, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->mahanghoa = $pdo->lastInsertId();
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function deleteHangHoa($pdo)
    {
        $sql = "DELETE FROM hanghoa WHERE mahanghoa = :mahanghoa";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":mahanghoa", $this->mahanghoa, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function updateHanghoa($pdo)
    {
        $sql = "UPDATE hanghoa SET tenhanghoa=:tenhanghoa, mota=:mota, soluong=:soluong, gia=:gia, diachi=:diachi, xuatxu=:xuatxu, hinh=:hinh, maloai=:maloai WHERE mahanghoa=:mahanghoa";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':tenhanghoa', $this->tenhanghoa, PDO::PARAM_STR);
        $stmt->bindParam(':mota', $this->mota, PDO::PARAM_STR);
        $stmt->bindParam(':soluong', $this->soluong, PDO::PARAM_INT);
        $stmt->bindParam(':gia', $this->gia, PDO::PARAM_INT);
        $stmt->bindParam(':diachi', $this->diachi, PDO::PARAM_STR);
        $stmt->bindParam(':xuatxu', $this->xuatxu, PDO::PARAM_STR);
        $stmt->bindParam(':hinh', $this->hinh, PDO::PARAM_STR);
        $stmt->bindParam(':maloai', $this->maloai, PDO::PARAM_INT);
        $stmt->bindParam(':mahanghoa', $this->mahanghoa, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }
}
