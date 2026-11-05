<?php
session_start();
include '../koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']);

    $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['status_login'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin | SMPN 1 Japah</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh; background:#e0f2fe;">
    <div class="news-card" style="width: 100%; max-width: 380px; padding: 30px;">
        <h3 style="text-align:center; color:#0284c7; margin-bottom:20px;">Login Admin Sekolah</h3>
        <?php if(isset($error)) echo "<p style='color:red; text-align:center; margin-bottom:10px;'>$error</p>"; ?>
        <form method="POST">
            <div style="margin-bottom: 15px;">
                <label>Username</label>
                <input type="text" name="username" required style="width:100%; padding:10px; margin-top:5px; border:1px solid #cbd5e1; border-radius:4px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label>Password</label>
                <input type="password" name="password" required style="width:100%; padding:10px; margin-top:5px; border:1px solid #cbd5e1; border-radius:4px;">
            </div>
            <button type="submit" name="login" class="btn-primary" style="width:100%; border:none; cursor:pointer;">Masuk</button>
        </form>
        <p style="text-align:center; margin-top:15px; font-size:13px;"><a href="../index.php" style="color:#64748b;">&larr; Kembali ke Beranda</a></p>
    </div>
</body>
</html>