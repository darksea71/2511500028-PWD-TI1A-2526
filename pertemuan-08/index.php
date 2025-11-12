<?php
session_start();

$nim        = $_SESSION["nim"]        ?? "";
$nama       = $_SESSION["nama"]       ?? "";
$tempat     = $_SESSION["tempat"]     ?? "";
$tgl_lahir  = $_SESSION["tgl_lahir"]  ?? "";
$hobi       = $_SESSION["hobi"]       ?? "";
$pasangan   = $_SESSION["pasangan"]   ?? "";
$pekerjaan  = $_SESSION["pekerjaan"]  ?? "";
$ortu       = $_SESSION["ortu"]       ?? "";
$kakak      = $_SESSION["kakak"]      ?? "";
$adik       = $_SESSION["adik"]       ?? "";

$sesnama  = $_SESSION["sesnama"]  ?? "";
$sesemail = $_SESSION["sesemail"] ?? "";
$sespesan = $_SESSION["sespesan"] ?? "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Profil Pengunjung</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>Selamat Datang</h1>
    <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">&#9776;</button>
    <nav>
      <ul>
        <li><a href="#home">Beranda</a></li>
        <li><a href="#form">Pengunjung</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <main>
    
    <section id="home">
      <h2>Selamat Datang</h2>
      <p>Halo dunia!<br>Nama saya hendy</p>
    </section>

    
    <section id="form">
      <h2>Pendaftaran Profil Pengunjung</h2>
      <form action="proses.php" method="POST">
        
        <label><span>NIM:</span>
          <input type="text" name="nim" placeholder="Masukkan NIM" value="<?= $nim ?>" required>
        </label>

        <label><span>Nama Lengkap:</span>
          <input type="text" name="nama" placeholder="Masukkan nama lengkap" value="<?= $nama ?>" required>
        </label>

        <label><span>Tempat Lahir:</span>
          <input type="text" name="tempat" placeholder="Masukkan tempat lahir" value="<?= $tempat ?>" required>
        </label>

        <label><span>Tanggal Lahir:</span>
          <input type="text" name="tgl_lahir" placeholder="Masukkan tanggal lahir" value="<?= $tgl_lahir ?>" required>
        </label>

        <label><span>Hobi:</span>
          <input type="text" name="hobi" placeholder="Masukkan hobi" value="<?= $hobi ?>">
        </label>

        <label><span>Pasangan:</span>
          <input type="text" name="pasangan" placeholder="Masukkan nama pasangan" value="<?= $pasangan ?>">
        </label>

        <label><span>Pekerjaan:</span>
          <input type="text" name="pekerjaan" placeholder="Masukkan pekerjaan" value="<?= $pekerjaan ?>">
        </label>

        <label><span>Nama Orang Tua:</span>
          <input type="text" name="ortu" placeholder="Masukkan nama orang tua" value="<?= $ortu ?>">
        </label>

        <label><span>Nama Kakak:</span>
          <input type="text" name="kakak" placeholder="Masukkan nama kakak" value="<?= $kakak ?>">
        </label>

        <label><span>Nama Adik:</span>
          <input type="text" name="adik" placeholder="Masukkan nama adik" value="<?= $adik ?>">
        </label>

        <div class="button-container">
          <button type="submit">Kirim</button>
          <button type="reset">Batal</button>
        </div>
      </form>
    </section>

    
    <section id="about">
      <h2>Tentang Saya</h2>
      <?php if (!empty($nim)): ?>
        <p><strong>NIM:</strong> <?= $nim ?></p>
        <p><strong>Nama Lengkap:</strong> <?= $nama ?> &#127926;</p>
        <p><strong>Tempat Lahir:</strong> <?= $tempat ?></p>
        <p><strong>Tanggal Lahir:</strong> <?= $tgl_lahir ?></p>
        <p><strong>Hobi:</strong> <?= $hobi ?></p>
        <p><strong>Pasangan:</strong> <?= $pasangan ?></p>
        <p><strong>Pekerjaan:</strong> <?= $pekerjaan ?></p>
        <p><strong>Nama Orang Tua:</strong> <?= $ortu ?></p>
        <p><strong>Nama Kakak:</strong> <?= $kakak ?></p>
        <p><strong>Nama Adik:</strong> <?= $adik ?></p>
      <?php else: ?>
        <p>Belum ada data pengunjung. Silakan isi form di atas &hearts;</p>
      <?php endif; ?>
    </section>

    
    <section id="contact">
      <h2>Kontak Kami</h2>
      <form action="proses.php" method="POST">
        <label><span>Nama:</span>
          <input type="text" name="txtNama" placeholder="Masukkan nama" required>
        </label>

        <label><span>Email:</span>
          <input type="email" name="txtEmail" placeholder="Masukkan email" required>
        </label>

        <label><span>Pesan Anda:</span>
          <textarea name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
        </label>

        <div class="button-container">
          <button type="submit">Kirim</button>
          <button type="reset">Batal</button>
        </div>
      </form>

      <?php if (!empty($sesnama)): ?>
        <hr>
        <h3>Yang Menghubungi Kami:</h3>
        <p><strong>Nama:</strong> <?= $sesnama ?></p>
        <p><strong>Email:</strong> <?= $sesemail ?></p>
        <p><strong>Pesan:</strong> <?= $sespesan ?></p>
      <?php endif; ?>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Hendy Junior Pereslin [2511500028]</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>