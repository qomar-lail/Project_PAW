<?php
$conn = new mysqli("localhost","root","","diary_learning_db");

session_start();
if(isset($_POST["login"])){
    $user_name = htmlspecialchars($_POST["username"]);
    $pw =($_POST["password"]);
    $pw_MD5 = md5($pw);
    $ambil_data = "SELECT password, nama_pengguna FROM pengguna";
    $find_data = $conn->query($ambil_data);
    while($row = $find_data->fetch_assoc()){
        if($row["password"] == $pw_MD5 && ($row["nama_pengguna"])==$user_name){
            $_SESSION["nama_pengguna"] = $row["nama_pengguna"];
            $_SESSION["login"] = true;
            header("location:index.php");
            exit;
        }
    }
    $error = "username atau passsword tidak valid";
}

$_SESSION["notif"] = "";

?>
