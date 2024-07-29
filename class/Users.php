<?php
class Users
{
    public $username;
    public $password;

    public static function getAllUser($pdo)
    {
        $sql = "SELECT * FROM user";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Users');
            return $stmt->fetchAll();
        }
    }
    
    public static function login($name, $pass)
    {
        $db = new Database();
        $pdo = $db->connect();

        $sql = "SELECT * from user where username= :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":username", $name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            if (!$data = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                return "Tên hoặc Mật khẩu không đúng";
            }
            $passDB = $data[0]['password'];

            if (password_verify($pass, $passDB)) {
                if($name == "admin"){
                    $_SESSION['log_detail'] = $name;
                    header("Location:Admin/index.php");
                    exit();
                } else {
                    $_SESSION['log_detail'] = $name;
                    header("Location:index.php");
                    exit();
                }
            } else {
                return "Tên hoặc Mật khẩu không đúng";
            }
        } else {
            return "Tên hoặc Mật khẩu không đúng";
        }
    }

    public static function logout()
    {
        if($_SESSION['log_detail'] == "admin"){
            unset($_SESSION['log_detail']);
            header("Location:../index.php");
            exit();
        } else {
            unset($_SESSION['log_detail']);
            header("Location:index.php");
            exit();
        }
       
    }

    public function addUser($pdo)
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {;
            return false;
        }
    }

    public static function kiemTraUser($pdo, $username)
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            if(!$stmt->fetchAll(PDO::FETCH_ASSOC)){
                return false;
            }
            return true;
        }
        return false;
    }

    public function updateUser($pdo)
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password = :password WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {;
            return false;
        }
    }

    public function deleteUser($pdo)
    {
        $sql = "DELETE FROM user WHERE username=:username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":username", $this->username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}