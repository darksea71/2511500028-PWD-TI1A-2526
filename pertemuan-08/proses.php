<?php
session_start();
$sesnama = $_POST["txtNama"];
$sesemail = $_POST["txtEmail"];
$sespesan = $_POST["txtPesan"];
$_SESSION["sesnama"] = $sesnama;
$_SESSION["sesemail"] = $sesemail;
$_SESSION["sespesan"] = $sespesan;
header("location: index.php");
?>

<?php
session_start();

if ($formType === 'register') {
  $_SESSION['profil'] = [
    'nim' => $_POST['nim'] ?? '',
    'nama' => $_POST['nama'] ?? '',
    'ttl' => $_POST['ttl'] ?? '',
    'hobi' => $_POST['hobi'] ?? '',
    'pasangan' => $_POST['pasangan'] ?? '',
    'pekerjaan' => $_POST['pekerjaan'] ?? '',
    'ortu' => $_POST['ortu'] ?? '',
    'kakak' => $_POST['kakak'] ?? '',
    'adik' => $_POST['adik'] ?? ''
  ];
  header("Location: index.php#about");
  exit;
}
?>

