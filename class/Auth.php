<?php
class Auth
{
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

    public static function add($name, $pass)
    {
        $db = new Database();
        $pdo = $db->connect();
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user(username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $name, PDO::PARAM_STR);
        $stmt->bindParam(':password', $pass, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
