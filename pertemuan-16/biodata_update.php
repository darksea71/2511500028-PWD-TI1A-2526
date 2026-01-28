<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

// Cek method form, hanya POST yang diizinkan
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_biodata_error'] = 'Akses tidak valid.';
    redirect_ke('biodata_read.php');
}

// Ambil dan validasi Kode
$ckode = filter_input(INPUT_POST, 'ckode', FILTER_VALIDATE_INT);

if (!$ckode) {
    $_SESSION['flash_biodata_error'] = 'Kode dosen tidak valid.';
    redirect_ke('biodata_edit.php?ckode=' . urlencode($ckode));
}

// Ambil dan bersihkan input lain
$kode     = bersihkan($_POST['txtKode'] ?? '');
$nama     = bersihkan($_POST['txtNama'] ?? '');
$alamat   = bersihkan($_POST['txtAlamat'] ?? '');
$tanggal  = bersihkan($_POST['txtTanggal'] ?? '');
$jja      = bersihkan($_POST['txtJja'] ?? '');
$prodi    = bersihkan($_POST['txtProdi'] ?? '');
$hp       = bersihkan($_POST['txtHp'] ?? '');
$pasangan = bersihkan($_POST['txtPasangan'] ?? '');
$anak     = bersihkan($_POST['txtAnak'] ?? '');
$bidang   = bersihkan($_POST['txtBidang'] ?? '');

// Validasi
$errors = [];

if ($kode === '')     $errors[] = 'Kode dosen wajib diisi.';
if ($nama === '')     $errors[] = 'Nama dosen wajib diisi.';
if ($alamat === '')   $errors[] = 'Alamat rumah wajib diisi.';
if ($tanggal === '')  $errors[] = 'Tanggal jadi dosen wajib diisi.';
if ($bidang === '')   $errors[] = 'Bidang ilmu wajib diisi.';
if (strlen($nama) < 3) $errors[] = 'Nama dosen minimal 3 karakter.';

// Jika ada error, simpan old input dan redirect
if (!empty($errors)) {
    $_SESSION['old_biodata'] = [
        'kode'     => $kode,
        'nama'     => $nama,
        'alamat'   => $alamat,
        'tanggal'  => $tanggal,
        'jja'      => $jja,
        'prodi'    => $prodi,
        'hp'       => $hp,
        'pasangan' => $pasangan,
        'anak'     => $anak,
        'bidang'   => $bidang,
    ];
    $_SESSION['flash_biodata_error'] = implode('<br>', $errors);
    redirect_ke('biodata_edit.php?ckode=' . urlencode($ckode));
}

// Prepared statement UPDATE
$stmt = mysqli_prepare($conn, "UPDATE tbl_biodata_dosen
    SET ckode_dosen = ?, cnama_dosen = ?, calamat_rumah = ?, ctanggal_jadi_dosen = ?,
        cjja_dosen = ?, chomebase_prodi = ?, cnomor_hp = ?,
        cnama_pasangan = ?, cnama_anak = ?, cbidang_ilmu_dosen = ?
    WHERE ckode = ?");

if (!$stmt) {
    $_SESSION['flash_biodata_error'] = 'Kesalahan sistem (prepare statement gagal).';
    redirect_ke('biodata_edit.php?ckode=' . urlencode($ckode));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssi",
    $kode,
    $nama,
    $alamat,
    $tanggal,
    $jja,
    $prodi,
    $hp,
    $pasangan,
    $anak,
    $bidang,
    $ckode
);

// Eksekusi
if (mysqli_stmt_execute($stmt)) {
    unset($_SESSION['old_biodata']);
    $_SESSION['flash_biodata_sukses'] = 'Biodata dosen berhasil diperbarui.';
    redirect_ke('biodata_read.php');
} else {
    $_SESSION['old_biodata'] = $_POST;
    $_SESSION['flash_biodata_error'] = 'Data gagal diperbarui. Silakan coba lagi.';
    redirect_ke('biodata_edit.php?ckode=' . urlencode($ckode));
}

// Tutup statement
mysqli_stmt_close($stmt);
