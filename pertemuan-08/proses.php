<?php
session_start();

if (isset($_POST["nim"])) {
  $_SESSION["nim"]        = $_POST["nim"];
  $_SESSION["nama"]       = $_POST["nama"];
  $_SESSION["tempat"]     = $_POST["tempat"];
  $_SESSION["tgl_lahir"]  = $_POST["tgl_lahir"];
  $_SESSION["hobi"]       = $_POST["hobi"];
  $_SESSION["pasangan"]   = $_POST["pasangan"];
  $_SESSION["pekerjaan"]  = $_POST["pekerjaan"];
  $_SESSION["ortu"]       = $_POST["ortu"];
  $_SESSION["kakak"]      = $_POST["kakak"];
  $_SESSION["adik"]       = $_POST["adik"];
}


if (isset($_POST["txtNama"])) {
  $_SESSION["sesnama"]  = $_POST["txtNama"];
  $_SESSION["sesemail"] = $_POST["txtEmail"];
  $_SESSION["sespesan"] = $_POST["txtPesan"];
}


header("Location: index.php");
exit;
?>