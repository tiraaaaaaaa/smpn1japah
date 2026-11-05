<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | SMP Negeri 1 Japah</title>
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
                <li><a href="index.php" class="active">Beranda</a></li>
                <li><a href="profil.php">Profil Sekolah</a></li>
                <li><a href="galeri.php">Galeri</a></li>
                <li><a href="ppdb.php">PPDB 2026</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container hero-content">
            <h2>Selamat Datang di Website Resmi<br>SMP Negeri 1 Japah</h2>
            <p>Mewujudkan Generasi Cerdas, Terampil, dan Berkarakter Mulia.</p>
            <a href="ppdb.php" class="btn-primary">Info PPDB 2026</a>
        </div>
    </section>

    <section class="container" style="margin-top: 40px; margin-bottom: -10px;">
        <div class="news-card" style="border-left: 5px solid #facc15; text-align: center; padding: 30px;">
            <h3 style="color: #0284c7; margin-bottom: 15px;">Visi Sekolah</h3>
            <p style="font-size: 18px; font-weight: bold; font-style: italic; color: #334155;">
                "Mewujudkan Generasi Cerdas, Terampil, Berbudaya Lingkungan, dan Berkarakter Mulia Berlandaskan Iman dan Takwa."
            </p>
        </div>
    </section>

    <main class="container main-layout">
        <div class="content-left">
            <div class="section-header">
                <h3>Pengumuman Terbaru</h3>
            </div>
            
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY tanggal DESC, id DESC");
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <article class="news-card">
                    <div class="news-date"><?php echo date('d M Y', strtotime($row['tanggal'])); ?></div>
                    <h4 class="news-title"><?php echo htmlspecialchars($row['judul']); ?></h4>
                    <p class="news-excerpt"><?php echo nl2br(htmlspecialchars($row['isi'])); ?></p>
                </article>
            <?php 
                }
            } else {
                echo "<p>Belum ada pengumuman terbaru.</p>";
            }
            ?>
        </div>

        <aside class="content-right">
            <div class="sidebar-box">
                <h3 class="sidebar-title">Kepala Sekolah</h3>
                <div class="profile-card">
                    <div class="profile-img-placeholder">Foto Kepsek</div>
                    <h4>Nama Kepala Sekolah</h4>
                    <p>NIP. 1970XXXXXXXXXXXXX</p>
                </div>
            </div>

            <div class="sidebar-box">
                <h3 class="sidebar-title">Pintasan Cepat</h3>
                <ul class="quick-links">
                    <li><a href="profil.php">Profil Sekolah</a></li>
                    <li><a href="galeri.php">Galeri Foto</a></li>
                    <li><a href="ppdb.php">Info PPDB</a></li>
                    <li><a href="admin/login.php">🔒 Login Admin</a></li>
                </ul>
            </div>
        </aside>
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