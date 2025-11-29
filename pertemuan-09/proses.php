<?php
session_start();
$arrKontak = [
    "nama" => $_POST["txtNama"] ?? "",
    "email" => $_POST["txtEmail"] ?? "",
    "pesan" => $_POST["txtPesan"] ?? "",
];

$_SESSION["sesnama"] = $sesnama;
$_SESSION["sesemail"] = $sesemail;
$_SESSION["sespesan"] = $sespesan;

$arrBiodata = [
    "nim" => $_POST["txtNim"] ?? "",
    "nama" => $_POST["txtNmLengkap"] ?? "",
    "tempat" => $_POST["txtT4Lhr"] ?? "",
    "tanggal" => $_POST["txtTglLhr"] ?? "",
    "hobi" => $_POST["txtHobi"] ?? "",
    "pasangan" => $_POST["txtPasangan"] ?? "",
    "pekerjaan" => $_POST["txtKerja"] ?? "",
    "ortu" => $_POST["txtNmOrtu"] ?? "",
    "kakak" => $_POST["txtNmKakak"] ?? "",
    "adik" => $_POST["txtNmAdik"] ?? ""
];

$_SESSION["biodata"] = $arrBiodata;;
$_SESSION["kontak"] = $arrKontak;
header("location: index.php#contact");
header("location: index.php");
?>