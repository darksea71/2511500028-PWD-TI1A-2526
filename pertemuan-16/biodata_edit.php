<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';


$ckode = filter_input(INPUT_GET, 'ckode', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if (!$ckode) {
  $_SESSION['flash_biodata_error'] = 'Akses tidak valid.';
  redirect_ke('biodata_read.php');
}


$stmt = mysqli_prepare(
  $conn,
  "SELECT ckode_dosen, cnama_dosen, calamat_rumah, ctanggal_jadi_dosen, cjja_dosen,
          chomebase_prodi, cnomor_hp, cnama_pasangan, cnama_anak, cbidang_ilmu_dosen
   FROM tbl_biodata_dosen
   WHERE ckode = ?
   LIMIT 1"
);

if (!$stmt) {
  $_SESSION['flash_biodata_error'] = 'Query tidak benar.';
  redirect_ke('biodata_read.php');
}

mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
  $_SESSION['flash_biodata_error'] = 'Data biodata tidak ditemukan.';
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
$flash_error = $_SESSION['flash_biodata_error'] ?? '';
$old = $_SESSION['old_biodata'] ?? [];

unset($_SESSION['flash_biodata_error'], $_SESSION['old_biodata']);

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

        <input type="text" name="cid" value="<?= (int)$cid; ?>">

        <label for="txtNim">
          <span>NIM:</span>
          <input type="text" id="txtNim" name="txtNim"
            value="<?= !empty($nim) ? $nim : '' ?>" readonly>
        </label>

        <label for="txtNama">
          <span>Nama Lengkap:</span>
          <input type="text" id="txtNama" name="txtNama"
            placeholder="Masukkan nama lengkap" required
            value="<?= !empty($nama) ? $nama : '' ?>">
        </label>

        <label for="txtTempat">
          <span>Tempat Lahir:</span>
          <input type="text" id="txtTempat" name="txtTempat"
            placeholder="Masukkan tempat lahir" required
            value="<?= !empty($tempat) ? $tempat : '' ?>">
        </label>

        <label for="txtTanggal">
          <span>Tanggal Lahir:</span>
          <input type="date" id="txtTanggal" name="txtTanggal" required
            value="<?= !empty($tanggal) ? $tanggal : '' ?>">
        </label>

        <label for="txtHobi">
          <span>Hobi:</span>
          <input type="text" id="txtHobi" name="txtHobi"
            placeholder="Masukkan hobi"
            value="<?= !empty($hobi) ? $hobi : '' ?>">
        </label>

        <label for="txtPasangan">
          <span>Pasangan:</span>
          <input type="text" id="txtPasangan" name="txtPasangan"
            placeholder="Masukkan pasangan"
            value="<?= !empty($pasangan) ? $pasangan : '' ?>">
        </label>

        <label for="txtPekerjaan">
          <span>Pekerjaan:</span>
          <input type="text" id="txtPekerjaan" name="txtPekerjaan"
            placeholder="Masukkan pekerjaan"
            value="<?= !empty($pekerjaan) ? $pekerjaan : '' ?>">
        </label>

        <label for="txtOrtu">
          <span>Nama Orang Tua:</span>
          <input type="text" id="txtOrtu" name="txtOrtu"
            placeholder="Masukkan nama orang tua"
            value="<?= !empty($ortu) ? $ortu : '' ?>">
        </label>

        <label for="txtKakak">
          <span>Nama Kakak:</span>
          <input type="text" id="txtKakak" name="txtKakak"
            placeholder="Masukkan nama kakak"
            value="<?= !empty($kakak) ? $kakak : '' ?>">
        </label>

        <label for="txtAdik">
          <span>Nama Adik:</span>
          <input type="text" id="txtAdik" name="txtAdik"
            placeholder="Masukkan nama adik"
            value="<?= !empty($adik) ? $adik : '' ?>">
        </label>


        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
        <a href="biodata_read.php">Kembali</a>
      </form>
    </section>
  </main>
</body>
</html>
