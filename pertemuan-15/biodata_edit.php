<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';


$cnim = filter_input(INPUT_GET, 'cnim', FILTER_SANITIZE_SPECIAL_CHARS);

if (!$cnim) {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('biodata_read.php');
}


$stmt = mysqli_prepare(
  $conn,
  "SELECT cnim, cnama_lengkap, ctempat_lahir, ctanggal_lahir,
          chobi, cpasangan, cpekerjaan,
          cnama_orang_tua, cnama_kakak, cnama_adik
   FROM tbl_biodata_mahasiswa
   WHERE cnim = ?
   LIMIT 1"
);

if (!$stmt) {
  $_SESSION['flash_error'] = 'Query tidak benar.';
  redirect_ke('biodata_read.php');
}

mysqli_stmt_bind_param($stmt, "s", $cnim);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
  $_SESSION['flash_error'] = 'Data biodata tidak ditemukan.';
  redirect_ke('biodata_read.php');
}

# Nilai awal (prefill form)
$nim       = $row['cnim'] ?? '';
$nama      = $row['cnama_lengkap'] ?? '';
$tempat   = $row['ctempat_lahir'] ?? '';
$tanggal  = $row['ctanggal_lahir'] ?? '';
$hobi      = $row['chobi'] ?? '';
$pasangan  = $row['cpasangan'] ?? '';
$pekerjaan = $row['cpekerjaan'] ?? '';
$ortu      = $row['cnama_orang_tua'] ?? '';
$kakak     = $row['cnama_kakak'] ?? '';
$adik      = $row['cnama_adik'] ?? '';

# Ambil error & old input
$flash_error = $_SESSION['flash_error'] ?? '';
$old = $_SESSION['old'] ?? [];

unset($_SESSION['flash_error'], $_SESSION['old']);

if (!empty($old)) {
  $nama      = $old['nama'] ?? $nama;
  $tempat   = $old['tempat'] ?? $tempat;
  $tanggal  = $old['tanggal'] ?? $tanggal;
  $hobi      = $old['hobi'] ?? $hobi;
  $pasangan  = $old['pasangan'] ?? $pasangan;
  $pekerjaan = $old['pekerjaan'] ?? $pekerjaan;
  $ortu      = $old['ortu'] ?? $ortu;
  $kakak     = $old['kakak'] ?? $kakak;
  $adik      = $old['adik'] ?? $adik;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Biodata Mahasiswa</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>Edit Biodata Mahasiswa</h1>
  </header>

  <main>
    <section id="biodata">
      <h2>Form Edit Biodata</h2>

      <?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px;
          background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
      <?php endif; ?>

      <form action="biodata_update.php" method="POST">

        <label>
          <span>NIM:</span>
          <input type="text" name="txtNim" value="<?= htmlspecialchars($nim); ?>" readonly>
        </label>

        <label>
          <span>Nama Lengkap:</span>
          <input type="text" name="txtNama" required value="<?= htmlspecialchars($nama); ?>">
        </label>

        <label>
          <span>Tempat Lahir:</span>
          <input type="text" name="txtTempat" required value="<?= htmlspecialchars($tempat); ?>">
        </label>

        <label>
          <span>Tanggal Lahir:</span>
          <input type="date" name="txtTanggal" required value="<?= htmlspecialchars($tanggal); ?>">
        </label>

        <label>
          <span>Hobi:</span>
          <input type="text" name="txtHobi" value="<?= htmlspecialchars($hobi); ?>">
        </label>

        <label>
          <span>Pasangan:</span>
          <input type="text" name="txtPasangan" value="<?= htmlspecialchars($pasangan); ?>">
        </label>

        <label>
          <span>Pekerjaan:</span>
          <input type="text" name="txtPekerjaan" value="<?= htmlspecialchars($pekerjaan); ?>">
        </label>

        <label>
          <span>Nama Orang Tua:</span>
          <input type="text" name="txtOrtu" value="<?= htmlspecialchars($ortu); ?>">
        </label>

        <label>
          <span>Nama Kakak:</span>
          <input type="text" name="txtKakak" value="<?= htmlspecialchars($kakak); ?>">
        </label>

        <label>
          <span>Nama Adik:</span>
          <input type="text" name="txtAdik" value="<?= htmlspecialchars($adik); ?>">
        </label>

        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
        <a href="biodata_read.php">Kembali</a>
      </form>
    </section>
  </main>
</body>
</html>
