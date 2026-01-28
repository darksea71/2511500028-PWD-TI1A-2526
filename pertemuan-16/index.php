<?php
session_start();
require_once __DIR__ . '/fungsi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Judul Halaman</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>Ini Header</h1>
    <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
      &#9776;
    </button>
    <nav>
      <ul>
        <li><a href="#home">Beranda</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="home">
      <h2>Selamat Datang</h2>
      <?php
      echo "halo dunia!<br>";
      echo "nama saya hadi";
      ?>
      <p>Ini contoh paragraf HTML.</p>
    </section>

    <?php
    $flash_biodata_sukses = $_SESSION['flash_biodata_sukses'] ?? '';
    $flash_biodata_error  = $_SESSION['flash_biodata_error'] ?? '';
    $old = $_SESSION['old_biodata'] ?? [];

    unset($_SESSION['flash_biodata_sukses'], $_SESSION['flash_biodata_error'], $_SESSION['old_biodata']);
    ?>

    <section id="biodata">
      <h2>Biodata Dosen</h2>

      <?php if (!empty($flash_biodata_sukses)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_biodata_sukses; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($flash_biodata_error)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_biodata_error; ?>
        </div>
      <?php endif; ?>

      <form action="biodata_proses.php" method="POST">

        <label for="txtKode"><span>Kode Dosen</span>
          <input type="text" id="txtKode" name="txtKode"
            placeholder="Masukkan Kode" required
            value="<?= isset($old['kode']) ? htmlspecialchars($old['kode']) : '' ?>">
        </label>

        <label for="txtNama"><span>Nama Dosen:</span>
          <input type="text" id="txtNama" name="txtNama"
            placeholder="Masukkan Nama Lengkap" required
            value="<?= isset($old['nama']) ? htmlspecialchars($old['nama']) : '' ?>">
        </label>

        <label for="txtTempat"><span>Alamat Rumah</span>
          <input type="text" id="txtTempat" name="txtTempat"
            placeholder="Masukkan Tempat Lahir" required
            value="<?= isset($old['tempat']) ? htmlspecialchars($old['tempat']) : '' ?>">
        </label>

        <label for="txtTanggal"><span>Tanggal Jadi Dosen:</span>
          <input type="date" id="txtTanggal" name="txtTanggal"
            required
            value="<?= isset($old['tanggal']) ? htmlspecialchars($old['tanggal']) : '' ?>">
        </label>

        <label for="txtHobi"><span>JJA Dosen:</span>
          <input type="text" id="txtHobi" name="txtHobi"
            placeholder="Masukkan Hobi"
            value="<?= isset($old['hobi']) ? htmlspecialchars($old['hobi']) : '' ?>">
        </label>

        <label for="txtPasangan"><span>Homebase Prodi:</span>
          <input type="text" id="txtPasangan" name="txtPasangan"
            placeholder="Masukkan Pasangan"
            value="<?= isset($old['pasangan']) ? htmlspecialchars($old['pasangan']) : '' ?>">
        </label>

        <label for="txtPekerjaan"><span>Nomor HP:</span>
          <input type="text" id="txtPekerjaan" name="txtPekerjaan"
            placeholder="Masukkan Pekerjaan"
            value="<?= isset($old['pekerjaan']) ? htmlspecialchars($old['pekerjaan']) : '' ?>">
        </label>

        <label for="txtOrtu"><span>Nama Pasangan:</span>
          <input type="text" id="txtOrtu" name="txtOrtu"
            placeholder="Masukkan Nama Orang Tua"
            value="<?= isset($old['ortu']) ? htmlspecialchars($old['ortu']) : '' ?>">
        </label>

        <label for="txtKakak"><span>Nama Anak:</span>
          <input type="text" id="txtKakak" name="txtKakak"
            placeholder="Masukkan Nama Kakak"
            value="<?= isset($old['kakak']) ? htmlspecialchars($old['kakak']) : '' ?>">
        </label>

        <label for="txtAdik"><span>Bidang Ilmu Dosen:</span>
          <input type="text" id="txtAdik" name="txtAdik"
            placeholder="Masukkan Nama Adik"
            value="<?= isset($old['adik']) ? htmlspecialchars($old['adik']) : '' ?>">
        </label>

        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>

    <?php
    $biodata = $_SESSION["biodata"] ?? [];

    $fieldConfig = [
      "kodedos" => ["label" => "Kode Dosen:", "suffix" => ""],
      "nama" => ["label" => "Nama Dosen:", "suffix" => " &#128526;"],
      "alamat" => ["label" => "Alamat Rumah:", "suffix" => ""],
      "tanggal" => ["label" => "Tanggal Jadi Dosen:", "suffix" => ""],
      "jja" => ["label" => "JJA Dosen:", "suffix" => " &#127926;"],
      "prodi" => ["label" => "Homebase Prodi:", "suffix" => " &hearts;"],
      "nohp" => ["label" => "Nomor HP:", "suffix" => " &copy; 2025"],
      "pasangan" => ["label" => "Nama Pasangan:", "suffix" => ""],
      "anak" => ["label" => "Nama Anak:", "suffix" => ""],
      "ilmu" => ["label" => "Bidang Ilmu Dosen:", "suffix" => ""],
    ];
    ?>

    <section id="about">
      <h2>Tentang Saya</h2>
      <?= tampilkanBiodata($fieldConfig, $biodata) ?>
    </section>

    <?php
    $flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
    $flash_error  = $_SESSION['flash_error'] ?? ''; #jika ada error
    $old          = $_SESSION['old'] ?? []; #untuk nilai lama form

    unset($_SESSION['flash_sukses'], $_SESSION['flash_error'], $_SESSION['old']); #bersihkan 3 session ini
    ?>

    <section id="contact">
      <h2>Kontak Kami</h2>

      <?php if (!empty($flash_sukses)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
      <?php endif; ?>

      <form action="proses.php" method="POST">

        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama"
            required autocomplete="name"
            value="<?= isset($old['nama']) ? htmlspecialchars($old['nama']) : '' ?>">
        </label>

        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email"
            required autocomplete="email"
            value="<?= isset($old['email']) ? htmlspecialchars($old['email']) : '' ?>">
        </label>

        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..."
            required><?= isset($old['pesan']) ? htmlspecialchars($old['pesan']) : '' ?></textarea>
          <small id="charCount">0/200 karakter</small>
        </label>

        <label for="txtCaptcha"><span>Captcha 2 + 3 = ?</span>
          <input type="number" id="txtCaptcha" name="txtCaptcha" placeholder="Jawab Pertanyaan..."
            required
            value="<?= isset($old['captcha']) ? htmlspecialchars($old['captcha']) : '' ?>">
        </label>

        <button type=" submit">Kirim</button>
          <button type="reset">Batal</button>
      </form>

      <br>
      <hr>
      <h2>Yang menghubungi kami</h2>
      <?php include 'read_inc.php'; ?>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>