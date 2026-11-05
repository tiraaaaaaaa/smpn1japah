<?php
session_start();
if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}
include '../koneksi.php';

// PROSES TAMBAH PENGUMUMAN
if (isset($_POST['tambah_pengumuman'])) {
    $tanggal = $_POST['tanggal'];
    $judul   = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi     = mysqli_real_escape_string($koneksi, $_POST['isi']);
    mysqli_query($koneksi, "INSERT INTO pengumuman (tanggal, judul, isi) VALUES ('$tanggal', '$judul', '$isi')");
    header("Location: index.php");
    exit;
}

// PROSES HAPUS PENGUMUMAN
if (isset($_GET['hapus_pengumuman'])) {
    $id = (int)$_GET['hapus_pengumuman'];
    mysqli_query($koneksi, "DELETE FROM pengumuman WHERE id=$id");
    header("Location: index.php");
    exit;
}

// PROSES TAMBAH GALERI FOTO
if (isset($_POST['tambah_galeri'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $foto  = $_FILES['foto']['name'];
    $tmp   = $_FILES['foto']['tmp_name'];
    $nama_baru = time() . '_' . $foto;
    
    if (move_uploaded_file($tmp, '../assets/' . $nama_baru)) {
        mysqli_query($koneksi, "INSERT INTO galeri (judul, foto) VALUES ('$judul', '$nama_baru')");
    }
    header("Location: index.php");
    exit;
}

// PROSES HAPUS GALERI FOTO
if (isset($_GET['hapus_galeri'])) {
    $id = (int)$_GET['hapus_galeri'];
    $ambil = mysqli_query($koneksi, "SELECT foto FROM galeri WHERE id=$id");
    $data = mysqli_fetch_assoc($ambil);
    if (file_exists('../assets/' . $data['foto'])) {
        unlink('../assets/' . $data['foto']);
    }
    mysqli_query($koneksi, "DELETE FROM galeri WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | SMPN 1 Japah</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="main-header" style="padding:15px 0;">
        <div class="container header-content">
            <h2 style="color:#0284c7;">Panel Admin SMPN 1 Japah</h2>
            <div>
                <a href="../index.php" target="_blank" style="margin-right:15px; color:#0284c7; font-weight:bold; text-decoration:none;">Lihat Web &rarr;</a>
                <a href="logout.php" class="btn-primary" style="background:#ef4444; color:white; padding:8px 15px;">Logout</a>
            </div>
        </div>
    </header>

    <main class="container main-layout">
        <!-- BAGIAN CRUD PENGUMUMAN -->
        <div class="content-left" style="flex:1;">
            <div class="news-card">
                <h3 style="color:#0284c7; margin-bottom:15px;">+ Tambah Pengumuman Baru</h3>
                <form method="POST">
                    <div style="margin-bottom:10px;">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" required value="<?php echo date('Y-m-d'); ?>" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                    </div>
                    <div style="margin-bottom:10px;">
                        <label>Judul Pengumuman</label>
                        <input type="text" name="judul" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                    </div>
                    <div style="margin-bottom:10px;">
                        <label>Isi Pengumuman</label>
                        <textarea name="isi" rows="4" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;"></textarea>
                    </div>
                    <button type="submit" name="tambah_pengumuman" class="btn-primary" style="border:none; cursor:pointer;">Simpan Pengumuman</button>
                </form>
            </div>

            <div class="news-card">
                <h3 style="color:#0284c7; margin-bottom:15px;">Daftar Pengumuman</h3>
                <table style="width:100%; border-collapse:collapse; font-size:14px;">
                    <tr style="background:#e0f2fe; text-align:left;">
                        <th style="padding:8px; border:1px solid #cbd5e1;">Tanggal</th>
                        <th style="padding:8px; border:1px solid #cbd5e1;">Judul</th>
                        <th style="padding:8px; border:1px solid #cbd5e1;">Aksi</th>
                    </tr>
                    <?php
                    $q_pengumuman = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY id DESC");
                    while ($p = mysqli_fetch_assoc($q_pengumuman)) {
                    ?>
                    <tr>
                        <td style="padding:8px; border:1px solid #cbd5e1;"><?php echo $p['tanggal']; ?></td>
                        <td style="padding:8px; border:1px solid #cbd5e1;"><?php echo htmlspecialchars($p['judul']); ?></td>
                        <td style="padding:8px; border:1px solid #cbd5e1;">
                            <a href="edit_pengumuman.php?id=<?php echo $p['id']; ?>" style="color:#0284c7; font-weight:bold; margin-right:8px;">Edit</a>
                            <a href="index.php?hapus_pengumuman=<?php echo $p['id']; ?>" onclick="return confirm('Yakin hapus?')" style="color:#ef4444; font-weight:bold;">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <!-- BAGIAN CRUD GALERI FOTO -->
        <div class="content-right" style="flex:1;">
            <div class="news-card">
                <h3 style="color:#0284c7; margin-bottom:15px;">+ Upload Foto Galeri</h3>
                <form method="POST" enctype="multipart/form-data">
                    <div style="margin-bottom:10px;">
                        <label>Judul / Keterangan Kegiatan</label>
                        <input type="text" name="judul" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                    </div>
                    <div style="margin-bottom:15px;">
                        <label>Pilih File Foto (JPG/PNG)</label>
                        <input type="file" name="foto" accept="image/*" required style="width:100%; margin-top:5px;">
                    </div>
                    <button type="submit" name="tambah_galeri" class="btn-primary" style="border:none; cursor:pointer;">Upload Foto</button>
                </form>
            </div>

            <div class="news-card">
                <h3 style="color:#0284c7; margin-bottom:15px;">Daftar Foto Galeri</h3>
                <table style="width:100%; border-collapse:collapse; font-size:14px;">
                    <tr style="background:#e0f2fe; text-align:left;">
                        <th style="padding:8px; border:1px solid #cbd5e1;">Foto</th>
                        <th style="padding:8px; border:1px solid #cbd5e1;">Keterangan</th>
                        <th style="padding:8px; border:1px solid #cbd5e1;">Aksi</th>
                    </tr>
                    <?php
                    $q_galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
                    while ($g = mysqli_fetch_assoc($q_galeri)) {
                    ?>
                    <tr>
                        <td style="padding:8px; border:1px solid #cbd5e1;">
                            <img src="../assets/<?php echo $g['foto']; ?>" style="width:60px; height:45px; object-fit:cover; border-radius:4px;">
                        </td>
                        <td style="padding:8px; border:1px solid #cbd5e1;"><?php echo htmlspecialchars($g['judul']); ?></td>
                        <td style="padding:8px; border:1px solid #cbd5e1;">
                            <a href="index.php?hapus_galeri=<?php echo $g['id']; ?>" onclick="return confirm('Hapus foto ini?')" style="color:#ef4444; font-weight:bold;">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </main>
</body>
</html>