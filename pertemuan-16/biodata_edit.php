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
  "SELECT ckode_dosen, cnama_dosen, calamat_rumah, ctanggal_jadi_dosen,
          cjja_dosen, chomebase_prodi, cnomor_hp,
          cnama_pasangan, cnama_anak, cbidang_ilmu_dosen
   FROM tbl_biodata_dosen
   WHERE ckode = ?
   LIMIT 1"
);

if (!$stmt) {
  $_SESSION['flash_biodata_error'] = 'Query tidak benar.';
  redirect_ke('biodata_read.php');
}

mysqli_stmt_bind_param($stmt, "i", $ckode);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
  $_SESSION['flash_biodata_error'] = 'Data biodata dosen tidak ditemukan.';
  redirect_ke('biodata_read.php');
}

# Nilai awal (prefill form)
$kode     = $row['ckode_dosen'] ?? '';
$nama     = $row['cnama_dosen'] ?? '';
$alamat   = $row['calamat_rumah'] ?? '';
$tanggal  = $row['ctanggal_jadi_dosen'] ?? '';
$jja      = $row['cjja_dosen'] ?? '';
$prodi    = $row['chomebase_prodi'] ?? '';
$hp       = $row['cnomor_hp'] ?? '';
$pasangan = $row['cnama_pasangan'] ?? '';
$anak     = $row['cnama_anak'] ?? '';
$bidang   = $row['cbidang_ilmu_dosen'] ?? '';

$flash_error = $_SESSION['flash_biodata_error'] ?? '';
$old = $_SESSION['old_biodata'] ?? [];

unset($_SESSION['flash_biodata_error'], $_SESSION['old_biodata']);

if (!empty($old)) {
  $nama     = $old['nama'] ?? $nama;
  $alamat   = $old['alamat'] ?? $alamat;
  $tanggal  = $old['tanggal'] ?? $tanggal;
  $jja      = $old['jja'] ?? $jja;
  $prodi    = $old['prodi'] ?? $prodi;
  $hp       = $old['hp'] ?? $hp;
  $pasangan = $old['pasangan'] ?? $pasangan;
  $anak     = $old['anak'] ?? $anak;
  $bidang   = $old['bidang'] ?? $bidang;
}
?>

