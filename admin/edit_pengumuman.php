<?php
session_start();
if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}
include '../koneksi.php';

$id = (int)$_GET['id'];
$ambil = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE id=$id");
$data = mysqli_fetch_assoc($ambil);

if (isset($_POST['update'])) {
    $tanggal = $_POST['tanggal'];
    $judul   = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi     = mysqli_real_escape_string($koneksi, $_POST['isi']);
    
    mysqli_query($koneksi, "UPDATE pengumuman SET tanggal='$tanggal', judul='$judul', isi='$isi' WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengumuman | SMPN 1 Japah</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background:#f8fafc; padding-top:40px;">
    <div class="container" style="max-width:600px;">
        <div class="news-card">
            <h3 style="color:#0284c7; margin-bottom:15px;">Edit Pengumuman</h3>
            <form method="POST">
                <div style="margin-bottom:10px;">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" required value="<?php echo $data['tanggal']; ?>" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div style="margin-bottom:10px;">
                    <label>Judul Pengumuman</label>
                    <input type="text" name="judul" required value="<?php echo htmlspecialchars($data['judul']); ?>" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div style="margin-bottom:15px;">
                    <label>Isi Pengumuman</label>
                    <textarea name="isi" rows="5" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;"><?php echo htmlspecialchars($data['isi']); ?></textarea>
                </div>
                <button type="submit" name="update" class="btn-primary" style="border:none; cursor:pointer;">Simpan Perubahan</button>
                <a href="index.php" style="margin-left:15px; color:#64748b;">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>