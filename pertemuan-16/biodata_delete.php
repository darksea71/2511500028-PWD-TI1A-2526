<?php
  session_start();
  require __DIR__ . '/koneksi.php';
  require_once __DIR__ . '/fungsi.php';

  #validasi ckode wajib angka dan > 0
  $ckode = filter_input(INPUT_GET, 'ckode', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);

  if (!$ckode) {
    $_SESSION['flash_biodata_error'] = 'Kode Dosen Tidak Valid.';
    redirect_ke('biodata_read.php');
  }

  /*
    Prepared statement untuk anti SQL injection.
    menyiapkan query DELETE dengan prepared statement 
    (WAJIB WHERE ckode = ?)
  */
  $stmt = mysqli_prepare($conn, "DELETE FROM tbl_biodata_dosen
                                WHERE ckode = ?");
  if (!$stmt) {
    #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
    $_SESSION['flash_biodata_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('biodata_read.php');
  }

  #bind parameter dan eksekusi (s = string, i = integer)
  mysqli_stmt_bind_param($stmt, "i", $ckode);

  if (mysqli_stmt_execute($stmt)) { #jika berhasil
    /*
      Redirect balik ke biodata_read.php dan tampilkan info sukses.
    */
    $_SESSION['flash_biodata_sukses'] = 'Data biodata dosen berhasil dihapus.';
  } else { #jika gagal, tampilkan error umum
    $_SESSION['flash_biodata_error'] = 'Data biodata dosen gagal dihapus. Silakan coba lagi.';
  }
  #tutup statement
  mysqli_stmt_close($stmt);

  redirect_ke('biodata_read.php');
