<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

$sql = "SELECT * FROM tbl_biodata_dosen ORDER BY ckode ASC";
$q = mysqli_query($conn, $sql);
if (!$q) {
    die("Query error: " . mysqli_error($conn));
}
?>

<?php
$flash_biodata_sukses = $_SESSION['flash_biodata_sukses'] ?? '';
$flash_biodata_error  = $_SESSION['flash_biodata_error'] ?? '';

unset($_SESSION['flash_biodata_sukses'], $_SESSION['flash_biodata_error']);
?>

<?php if (!empty($flash_biodata_sukses)): ?>
  <div style="padding:10px; margin-bottom:10px;
       background:#d4edda; color:#155724; border-radius:6px;">
    <?= $flash_biodata_sukses; ?>
  </div>
<?php endif; ?>

<?php if (!empty($flash_biodata_error)): ?>
  <div style="padding:10px; margin-bottom:10px;
       background:#f8d7da; color:#721c24; border-radius:6px;">
    <?= $flash_biodata_error; ?>
  </div>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>ID</th>
    <th>Kode Dosen</th>
    <th>Nama Dosen</th>
    <th>Alamat Rumah</th>
    <th>Tanggal Jadi Dosen</th>
    <th>JJA Dosen</th>
    <th>Homebase Prodi</th>
    <th>Nomor HP</th>
    <th>Nama Pasangan</th>
    <th>Nama Anak</th>
    <th>Bidang Ilmu</th>
  </tr>

  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="biodata_edit.php?ckode=<?= (int)$row['ckode']; ?>">Edit</a>
        <a onclick="return confirm('Hapus biodata <?= htmlspecialchars($row['cnama_dosen']); ?>?')"
           href="biodata_delete.php?ckode=<?= (int)$row['ckode']; ?>">
          Delete
        </a>
      </td>
      <td><?= $row['ckode']; ?></td>
      <td><?= htmlspecialchars($row['ckode_dosen']); ?></td>
      <td><?= htmlspecialchars($row['cnama_dosen']); ?></td>
      <td><?= htmlspecialchars($row['calamat_rumah']); ?></td>
      <td><?= htmlspecialchars($row['ctanggal_jadi_dosen']); ?></td>
      <td><?= htmlspecialchars($row['cjja_dosen']); ?></td>
      <td><?= htmlspecialchars($row['chomebase_prodi']); ?></td>
      <td><?= htmlspecialchars($row['cnomor_hp']); ?></td>
      <td><?= htmlspecialchars($row['cnama_pasangan']); ?></td>
      <td><?= htmlspecialchars($row['cnama_anak']); ?></td>
      <td><?= htmlspecialchars($row['cbidang_ilmu_dosen']); ?></td>
    </tr>
  <?php endwhile; ?>
</table>
