<?php
session_start();

require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_biodata_error'] = 'Akses tidak valid.';
    redirect_ke('index.php#biodata');
}

$nim       = bersihkan($_POST['txtNim'] ?? '');
$nama      = bersihkan($_POST['txtNama'] ?? '');
$tempat    = bersihkan($_POST['txtTempat'] ?? '');
$tanggal   = bersihkan($_POST['txtTanggal'] ?? '');
$hobi      = bersihkan($_POST['txtHobi'] ?? '');
$pasangan  = bersihkan($_POST['txtPasangan'] ?? '');
$pekerjaan = bersihkan($_POST['txtPekerjaan'] ?? '');
$ortu      = bersihkan($_POST['txtOrtu'] ?? '');
$kakak     = bersihkan($_POST['txtKakak'] ?? '');
$adik      = bersihkan($_POST['txtAdik'] ?? '');


$errors = [];

if ($nim === '')      $errors[] = 'NIM wajib diisi.';
if ($nama === '')     $errors[] = 'Nama lengkap wajib diisi.';
if ($tempat === '')   $errors[] = 'Tempat lahir wajib diisi.';
if ($tanggal === '')  $errors[] = 'Tanggal lahir wajib diisi.';

if (strlen($nim) < 5)  $errors[] = 'NIM minimal 5 angka.';
if (strlen($nama) < 3) $errors[] = 'Nama minimal 3 karakter.';
if (!ctype_digit($nim))$errors[] = 'NIM harus berupa angka.';

if (!empty($errors)) {
    $_SESSION['old_biodata'] = [
        'nim'       => $nim,
        'nama'      => $nama,
        'tempat'    => $tempat,
        'tanggal'   => $tanggal,
        'hobi'      => $hobi,
        'pasangan'  => $pasangan,
        'pekerjaan' => $pekerjaan,
        'ortu'      => $ortu,
        'kakak'     => $kakak,
        'adik'      => $adik,
    ];

    $_SESSION['flash_biodata_error'] = implode('<br>', $errors);
    redirect_ke('index.php#biodata');
}


$sql = "INSERT INTO tbl_biodata_mahasiswa
        (cnim, cnama_lengkap, ctempat_lahir, ctanggal_lahir, chobi,
         cpasangan, cpekerjaan, cnama_orang_tua, cnama_kakak, cnama_adik)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    $_SESSION['flash_biodata_error'] = 'Kesalahan sistem (prepare statement gagal).';
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
    $pekerjaan,
    $ortu,
    $kakak,
    $adik
);

if (mysqli_stmt_execute($stmt)) {
    unset($_SESSION['old_biodata']);
    $_SESSION['flash_biodata_sukses'] = 'Biodata mahasiswa berhasil disimpan.';
    redirect_ke('index.php#biodata');
} else {
    $_SESSION['old_biodata'] = $_POST;
    $_SESSION['flash_biodata_error'] = 'Data biodata gagal disimpan.';
    redirect_ke('index.php#biodata');
}

mysqli_stmt_close($stmt);
