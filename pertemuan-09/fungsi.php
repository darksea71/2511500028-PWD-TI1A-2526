<?php
function bersihkan($str)
{
    return htmlspecialchars(trim($str));
}
    function tidakKosong($str)
{
    return strlen(trim($str)) > 0;
}
    function formatTanggal($tgl)
{
    return date("d M Y", strtotime($tgl));
}

function tampilkanBiodata($conf, $arr)
{
    $html = "";
    foreach ($conf as $k => $v) {
    $label = $v["label"];
    $nilai = bersihkan($arr[$k] ?? '');
    $suffix = $v["suffix"];

    $html .= "<p><strong>{$label}</strong> {$nilai}{$suffix}</p>";
    }
    return $html;
}

function tampilkanKontak($config, $array)
{
    $kontak = "";
    foreach ($config as $kunci => $value) {
        $label = $value["label"];
        $isi = bersihkan($array[$kunci] ?? '');
        $suffix = $value["suffix"];

        $kontak .= "<label><span>{$label}</span> {$isi}{$suffix}</label>";
    }
    return $kontak;
}
?>