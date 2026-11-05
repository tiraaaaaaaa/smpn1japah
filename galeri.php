<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri | SMP Negeri 1 Japah</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="top-bar">
        <div class="container top-bar-content">
            <div class="top-contact">
                <span>✉ smpn1japah@sch.id</span>
                <span>📞 (0296) XXXXXX</span>
            </div>
            <div class="top-location">
                <span>📍 Kab. Blora, Jawa Tengah</span>
            </div>
        </div>
    </div>

    <header class="main-header">
        <div class="container header-content">
            <div class="brand">
                <img src="assets/logo.png" alt="Logo SMPN 1 Japah" class="brand-logo" onerror="this.src='https://via.placeholder.com/70/00A651/FFFFFF?text=LOGO'">
                <div class="brand-text">
                    <h1>SMP NEGERI 1 JAPAH</h1>
                    <p>Sekolah Berintegritas & Berprestasi</p>
                </div>
            </div>
            <div class="header-badge">NPSN: 203149XX</div>
        </div>
    </header>

    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="profil.php">Profil Sekolah</a></li>
                <li><a href="galeri.php" class="active">Galeri</a></li>
                <li><a href="ppdb.php">PPDB 2026</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero-section" style="padding: 40px 0; background-image: linear-gradient(rgba(2, 132, 199, 0.95), rgba(2, 132, 199, 0.95));">
        <div class="container hero-content">
            <h2 style="margin-bottom: 0;">Galeri Kegiatan Sekolah</h2>
        </div>
    </section>

    <main class="container" style="margin-top: 40px; margin-bottom: 60px;">
        <div class="section-header">
            <h3>Dokumentasi Terbaru</h3>
        </div>
        
        <div class="gallery-grid">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="gallery-item">
                    <img src="assets/<?php echo htmlspecialchars($row['foto']); ?>" alt="<?php echo htmlspecialchars($row['judul']); ?>" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="gallery-caption"><?php echo htmlspecialchars($row['judul']); ?></div>
                </div>
            <?php
                }
            } else {
                echo "<p>Belum ada foto di galeri. Silakan tambahkan melalui halaman Admin.</p>";
            }
            ?>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container footer-content">
            <div class="footer-col">
                <h3>SMP Negeri 1 Japah</h3>
                <p>Jl. Raya Japah, Kec. Japah, Kab. Blora<br>Provinsi Jawa Tengah, Indonesia</p>
            </div>
            <div class="footer-col">
                <h3>Kontak</h3>
                <p>Email: smpn1japah@sch.id<br>Telepon: (0296) XXXXXX</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 SMP Negeri 1 Japah. Dibuat untuk Tugas Teknologi Web.</p>
        </div>
    </footer>
</body>
</html>