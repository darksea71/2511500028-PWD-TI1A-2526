<?php
session_start();

require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_biodata_error'] = 'Akses tidak valid.';
    redirect_ke('index.php#biodata');
}

$kode      = bersihkan($_POST['txtKode'] ?? '');
$nama      = bersihkan($_POST['txtNama'] ?? '');
$alamat    = bersihkan($_POST['txtalamat'] ?? '');
$tanggal   = bersihkan($_POST['txtTanggal'] ?? '');
$jja       = bersihkan($_POST['txtJja'] ?? '');
$prodi     = bersihkan($_POST['txtProdi'] ?? '');
$hp        = bersihkan($_POST['txtHp'] ?? '');
$pasangan  = bersihkan($_POST['txtPasangan'] ?? '');
$anak      = bersihkan($_POST['txtAnak'] ?? '');
$bidang    = bersihkan($_POST['txtBidang'] ?? '');


$errors = [];

if ($kode === '')     $errors[] = 'Kode dosen wajib diisi.';
if ($nama === '')     $errors[] = 'Nama dosen wajib diisi.';
if ($alamat === '')   $errors[] = 'alamat rumah wajib diisi.';
if ($tanggal === '')  $errors[] = 'Tanggal jadi dosen wajib diisi.';
if ($jja === '')      $errors[] = 'Jja dosen wajib diisi.';
if ($prodi === '')    $errors[] = 'Homebase prodi wajib diisi.';
if ($hp === '')       $errors[] = 'Nomor HP wajib diisi.';
if ($bidang === '')   $errors[] = 'Bidang ilmu dosen wajib diisi.';

if (strlen($kode) < 5)  $errors[] = 'kode minimal 5 angka.';
if (strlen($nama) < 3) $errors[] = 'Nama minimal 3 karakter.';
if (!ctype_digit($nim))$errors[] = 'NIM harus berupa angka.';

if (!empty($errors)) {
    $_SESSION['old_biodata'] = [
        'kode'      => $kode,
        'nama'      => $nama,
        'alamat'    => $alamat,
        'tanggal'   => $tanggal,
        'jja'       => $jja,
        'prodi'     => $prodi,
        'hp'        => $hp,
        'pasangan'  => $pasangan,
        'anak'      => $anak,
        'bidang'    => $bidang,
    ];

    $_SESSION['flash_biodata_error'] = implode('<br>', $errors);
    redirect_ke('index.php#biodata');
}


$sql = "INSERT INTO tbl_biodata_dosen
        (ckode_dosen, cnama_dosen, calamat_rumah, ctanggal_jadi_dosen, 	cjja_dosen,
         chomebase_prodi, cnomor_hp, cnama_pasangan, cnama_anak, cbidang_ilmu_dosen)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    $_SESSION['flash_biodata_error'] = 'Kesalahan sistem (prepare statement gagal).';
    redirect_ke('index.php#biodata');
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssss",
    $kode,
    $nama,
    $alamat,
    $tanggal,
    $jja,
    $prodi,
    $hp,
    $pasangan,
    $anak,
    $bidang
);

if (mysqli_stmt_execute($stmt)) {
    unset($_SESSION['old_biodata']);
    $_SESSION['flash_biodata_sukses'] = 'Biodata dosen berhasil disimpan.';
    redirect_ke('index.php#biodata');
} else {
    $_SESSION['old_biodata'] = $_POST;
    $_SESSION['flash_biodata_error'] = 'Data biodata gagal disimpan.';
    redirect_ke('index.php#biodata');
}

mysqli_stmt_close($stmt);
