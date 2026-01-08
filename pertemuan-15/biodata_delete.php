<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

# validasi cnim wajib angka dan > 0
$nim = filter_input(INPUT_POST, 'txtNim', FILTER_SANITIZE_NUMBER_INT);


/*
  Prepared statement untuk anti SQL injection.
  menyiapkan query DELETE dengan prepared statement 
  (WAJIB WHERE cnim = ?)
*/
$stmt = mysqli_prepare($conn, "DELETE FROM tbl_biodata_mahasiswa
                              WHERE cnim = ?");
if (!$stmt) {
    # jika gagal prepare, kirim pesan error (tanpa detail sensitif)
    $_SESSION['flash_biodata_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('biodata_read.php');
}

# bind parameter dan eksekusi (s = string, i = integer)
mysqli_stmt_bind_param($stmt, "i", $cnim);

if (mysqli_stmt_execute($stmt)) { # jika berhasil, kosongkan old value
    /*
      Redirect balik ke biodata_read.php dan tampilkan info sukses.
    */
    $_SESSION['flash_biodata_sukses'] = 'Biodata mahasiswa berhasil dihapus.';
} else { # jika gagal, tampilkan error umum
    $_SESSION['flash_biodata_error'] = 'Data gagal dihapus. Silakan coba lagi.';
}

# tutup statement
mysqli_stmt_close($stmt);

redirect_ke('biodata_read.php');
