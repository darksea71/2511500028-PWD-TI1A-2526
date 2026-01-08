<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

// Cek method form, hanya POST yang diizinkan
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_biodata_error'] = 'Akses tidak valid.';
    redirect_ke('biodata_read.php');
}

// Ambil dan validasi NIM
$nim = filter_input(INPUT_POST, 'txtNim', FILTER_SANITIZE_NUMBER_INT);

if (!$nim || !ctype_digit($nim)) {
    $_SESSION['flash_biodata_error'] = 'NIM tidak valid.';
    redirect_ke('biodata_edit.php?cnim=' . urlencode($nim));
}

// Ambil dan bersihkan input lain
$nama      = bersihkan($_POST['txtNama'] ?? '');
$tempat    = bersihkan($_POST['txtTempat'] ?? '');
$tanggal   = bersihkan($_POST['txtTanggal'] ?? '');
$hobi      = bersihkan($_POST['txtHobi'] ?? '');
$pasangan  = bersihkan($_POST['txtPasangan'] ?? '');
$pekerjaan = bersihkan($_POST['txtPekerjaan'] ?? '');
$ortu      = bersihkan($_POST['txtOrtu'] ?? '');
$kakak     = bersihkan($_POST['txtKakak'] ?? '');
$adik      = bersihkan($_POST['txtAdik'] ?? '');

// Validasi
$errors = [];

if ($nama === '')      $errors[] = 'Nama lengkap wajib diisi.';
if ($tempat === '')    $errors[] = 'Tempat lahir wajib diisi.';
if ($tanggal === '')   $errors[] = 'Tanggal lahir wajib diisi.';
if (strlen($nama) < 3) $errors[] = 'Nama minimal 3 karakter.';

// Jika ada error, simpan old input dan redirect
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
    redirect_ke('biodata_edit.php?cnim=' . urlencode($nim));
}

// Prepared statement UPDATE
$stmt = mysqli_prepare($conn, "UPDATE tbl_biodata_mahasiswa
    SET cnama_lengkap = ?, ctempat_lahir = ?, ctanggal_lahir = ?, chobi = ?,
        cpasangan = ?, cpekerjaan = ?, cnama_orang_tua = ?, cnama_kakak = ?, cnama_adik = ?
    WHERE cnim = ?");

if (!$stmt) {
    $_SESSION['flash_biodata_error'] = 'Kesalahan sistem (prepare statement gagal).';
    redirect_ke('biodata_edit.php?cnim=' . urlencode($nim));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssss",
    $nama,
    $tempat,
    $tanggal,
    $hobi,
    $pasangan,
    $pekerjaan,
    $ortu,
    $kakak,
    $adik,
    $nim
);

// Eksekusi
if (mysqli_stmt_execute($stmt)) {
    unset($_SESSION['old_biodata']);
    $_SESSION['flash_biodata_sukses'] = 'Biodata mahasiswa berhasil diperbarui.';
    redirect_ke('biodata_read.php');
} else {
    $_SESSION['old_biodata'] = $_POST;
    $_SESSION['flash_biodata_error'] = 'Data gagal diperbarui. Silakan coba lagi.';
    redirect_ke('biodata_edit.php?cnim=' . urlencode($nim));
}

// Tutup statement
mysqli_stmt_close($stmt);
