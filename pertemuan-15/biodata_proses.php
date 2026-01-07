<?php
session_start();

require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('index.php#biodata');
}

$nim       = bersihkan($_POST['txtNim'] ?? '');
$nama      = bersihkan($_POST['txtNmLengkap'] ?? '');
$tempat    = bersihkan($_POST['txtT4Lhr'] ?? '');
$tanggal   = bersihkan($_POST['txtTglLhr'] ?? '');
$hobi      = bersihkan($_POST['txtHobi'] ?? '');
$pasangan  = bersihkan($_POST['txtPasangan'] ?? '');
$kerja     = bersihkan($_POST['txtKerja'] ?? '');
$ortu      = bersihkan($_POST['txtNmOrtu'] ?? '');
$kakak     = bersihkan($_POST['txtNmKakak'] ?? '');
$adik      = bersihkan($_POST['txtNmAdik'] ?? '');


$errors = [];

if ($nim === '')          $errors[] = 'NIM wajib diisi.';
if ($nama === '')         $errors[] = 'Nama lengkap wajib diisi.';
if ($tempat === '')       $errors[] = 'Tempat lahir wajib diisi.';
if ($tanggal === '')      $errors[] = 'Tanggal lahir wajib diisi.';
if ($kerja === '')        $errors[] = 'Pekerjaan wajib diisi.';
if ($ortu === '')         $errors[] = 'Nama orang tua wajib diisi.';

if (strlen($nim) < 5)     $errors[] = 'NIM minimal 5 karakter.';
if (strlen($nama) < 3)    $errors[] = 'Nama minimal 3 karakter.';


if (!empty($errors)) {
    $_SESSION['old_biodata'] = [
        'nim'       => $nim,
        'nama'      => $nama,
        'tempat'    => $tempat,
        'tanggal'   => $tanggal,
        'hobi'      => $hobi,
        'pasangan'  => $pasangan,
        'pekerjaan' => $kerja,
        'ortu'      => $ortu,
        'kakak'     => $kakak,
        'adik'      => $adik,
    ];

    $_SESSION['flash_error'] = implode('<br>', $errors);
    redirect_ke('index.php#biodata');
}


$sql = "INSERT INTO tbl_biodata_mahasiswa
        (cnim, cnama_lengkap, ctempat_lahir, ctanggal_lahir, chobi,
         cpasangan, cpekerjaan, cnama_orang_tua, cnama_kakak, cnama_adik)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    $_SESSION['flash_error'] = 'Kesalahan sistem (prepare statement gagal).';
    redirect_ke('index.php#biodata');
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssss",
    $nim,
    $nama,
    $tempat,
    $tanggal,
    $hobi,
    $pasangan,
    $kerja,
    $ortu,
    $kakak,
    $adik
);

if (mysqli_stmt_execute($stmt)) {
    unset($_SESSION['old_biodata']);
    $_SESSION['flash_sukses'] = 'Biodata mahasiswa berhasil disimpan.';
    redirect_ke('index.php#biodata');
} else {
    $_SESSION['old_biodata'] = $_POST;
    $_SESSION['flash_error'] = 'Data biodata gagal disimpan.';
    redirect_ke('index.php#biodata');
}

mysqli_stmt_close($stmt);
