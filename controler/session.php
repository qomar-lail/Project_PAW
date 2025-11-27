<?php
require_once __DIR__. "../../Model/koneksi.php";

if(isset($_POST["login"])){
    $user_name = htmlspecialchars($_POST["username"]);
    $pw =($_POST["password"]);
    $pw_MD5 = md5($pw);
    $ambil_data = "SELECT kata_sandi_hash, nama_pengguna FROM pengguna";
    $find_data = $conn->query($ambil_data);
    while($row = $find_data->fetch_assoc()){
        if($row["kata_sandi_hash"] == $pw_MD5 && ($row["nama_pengguna"])==$user_name){
            session_start();
            $_SESSION["nama_pengguna"] = $row["nama_pengguna"];
            $_SESSION["login"] = true;
            header("location:index.php");
        }
    }
    $error = "username atau passsword tidak valid";
}

?>
