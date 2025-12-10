<?php
$conn = new mysqli("localhost","root","","diary_learning_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

session_start();

if (isset($_POST["login"])) {
    $user_name = htmlspecialchars(trim($_POST["username"] ?? ""));
    $pw        = $_POST["password"] ?? "";
    $pw_MD5    = md5($pw);

    $u = $conn->real_escape_string($user_name);
    $sql_admin = "SELECT admin_id, username, password, nama_lengkap FROM admin WHERE username='$u' LIMIT 1";
    $res_admin = $conn->query($sql_admin);

    if ($res_admin && $res_admin->num_rows === 1) {
        $a = $res_admin->fetch_assoc();
        if ($a["password"] === $pw_MD5) {
            $_SESSION["login"] = true;
            $_SESSION["role"]  = "admin";

            $_SESSION["admin_id"]     = (int)$a["admin_id"];
            $_SESSION["username"]     = $a["username"];
            $_SESSION["nama_lengkap"] = $a["nama_lengkap"];

            $_SESSION["nama_pengguna"] = $a["nama_lengkap"];

            header("location: admin_dashboard.php");
            exit;
        }
    }

$sql_user = "SELECT pengguna_id, nama_pengguna, password
             FROM pengguna
             WHERE nama_pengguna='$u'
             LIMIT 1";
$res_user = $conn->query($sql_user);

if ($res_user && $res_user->num_rows === 1) {
    $row = $res_user->fetch_assoc();
    if ($row["password"] === $pw_MD5) {
        $_SESSION["nama_pengguna"] = $row["nama_pengguna"];
        $_SESSION["id"]            = (int)$row["pengguna_id"];
        $_SESSION["login"]         = true;
        $_SESSION["role"]          = "user";
        header("location: index.php");
        exit;
    }
}

    $error = "Username atau Password tidak valid";
}

$_SESSION["notif"] = $_SESSION["notif"] ?? "";
?>
