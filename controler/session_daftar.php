<?php
session_start();
$conn = new mysqli("localhost","root","","diary_learning_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$data_sekolah = "SELECT nama_sekolah FROM sekolah";
$ls = $conn->query($data_sekolah);
$sekolah = [];
while($row = $ls->fetch_assoc()){
    $sekolah[] = $row;
}


if (isset($_POST["daftar"])) {
    $nama = htmlspecialchars(trim($_POST["username"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $sekolah = !empty($_POST["id_sekolah"]) ? $_POST["id_sekolah"] : NULL;
    $pw        = $_POST["password"] ?? "";
    echo "$sekolah";
    $password    = md5($pw);

    $stmt = $conn->prepare("INSERT INTO pengguna (nama_pengguna, email, password, sekolah_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nama, $email, $password, $sekolah);

    if ($stmt->execute()){
        header("location:form_login.php");
    }
}
?>
