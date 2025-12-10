<?php
$conn = new mysqli("localhost","root","","diary_learning_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

session_start();

if (isset($_POST["login"])) {

    $username = trim($_POST["username"] ?? "");
    $pw       = trim($_POST["password"] ?? "");
    $pwMD5    = md5($pw);

    // ==== LOGIN ADMIN ====
    $u = $conn->real_escape_string($username);
    $sql_admin = "SELECT * FROM admin WHERE username='$u' LIMIT 1";
    $res_admin = $conn->query($sql_admin);

    if ($res_admin && $res_admin->num_rows === 1) {
        $a = $res_admin->fetch_assoc();
        if ($a["password"] === $pwMD5) {

            $_SESSION["login"] = true;
            $_SESSION["role"]  = "admin";
            $_SESSION["admin_id"]     = $a["admin_id"];
            $_SESSION["username"]     = $a["username"];
            $_SESSION["nama_lengkap"] = $a["nama_lengkap"];

            header("location: admin_dashboard.php");
            exit;
        }
    }

    // ==== LOGIN USER ====
    $sql_user = "
        SELECT p.pengguna_id, p.nama_pengguna, p.password, pb.tanggal_akses
        FROM pengguna p
        LEFT JOIN progress_belajar pb
        ON p.pengguna_id = pb.pengguna_id
        WHERE p.nama_pengguna = '$u'
        LIMIT 1
    ";
    $res_user = $conn->query($sql_user);

    if ($res_user && $res_user->num_rows === 1) {

        $row = $res_user->fetch_assoc();

        if ($row["password"] === $pwMD5) {

            $id         = (int)$row["pengguna_id"];
            $lastAccess = $row["tanggal_akses"];  // format Y-m-d
            $today      = date("Y-m-d");

            // ==== Jika progress_belajar belum ada, buat baru ====
            if ($lastAccess === NULL) {
                $conn->query("INSERT INTO progress_belajar 
                    (pengguna_id, level_id, judul_progress, materi_terakhir, skor, tanggal_akses)
                    VALUES ($id, 1, 'Beginner', 'Chapter Akhir Beginner', 0, '$today')
                ");
                $lastAccess = $today;
            }

            // ==== Update tanggal akses jika hari berbeda ====
            if ($lastAccess != $today) {
                $conn->query("UPDATE progress_belajar 
                              SET tanggal_akses = '$today'
                              WHERE pengguna_id = $id");
                $lastAccess = $today;
            }

            // ==== Buat Session ====
            $_SESSION["login"]         = true;
            $_SESSION["role"]          = "user";
            $_SESSION["id"]            = $id;
            $_SESSION["nama_pengguna"] = $row["nama_pengguna"];
            $_SESSION["tanggal_akses"] = $today;        
            $_SESSION["tanggal_asli"]  = $lastAccess;  

            $_SESSION["halaman"]        = "Dashboard";

            header("location: index.php");
            exit;
        }
    }

    // Jika tidak lolos
    $_SESSION["notif"] = "Username atau Password salah!";
}
?>
