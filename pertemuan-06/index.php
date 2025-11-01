<!DOCTYPE html> 
<html lang="id"> 
 
<head> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>Pertemuan 2</title>
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head> 
 
<body> 
    <header> 
        <h1>Ini Header</h1>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
            &#9776;
        </button>
        <nav> 
            <ul> 
            <li><a href="#home">Beranda</a></li> 
            <li><a href="#about">Tentang</a></li> 
            <li><a href="#contact">Kontak</a></li> 
            </ul> 
        </nav> 
    </header> 
 
    <main> 
        <section id="home"> 
        <h2>Selamat Datang</h2> 
        <?php
        echo "halo dunia!<br>";
        echo "ini website saya";
        ?>
        <p>Ini contoh paragraf HTML.</p> 
        </section> 
 
        <section id="about"> 
            <?php
                $nim = 2511500028;
                $Nim = "0202500025";
                $nama = "Hendy Junior Pereslin";
                $tempat_tanggallahir = "Jakarta, 09-07-2005 &#128512";
                $hobi = "Basket &hearts;";
                $pasangan = "Belum";
                $pekerjaan = "Pelajar";
                $nama_orang_tua = "Hendy";
                $nama_adek = "Cella";
            ?>
        <h2>Tentang Kami</h2> 
        <p><strong>NIM:</strong> 
            <?php
                echo $Nim;
            ?>
        </p>
        <p><strong>Nama:</strong>
            <?php
                echo $nama;
            ?>
        </p>
        <p><strong>Tempat/Tanggal Lahir:</strong>
            <?php
                echo $tempat_tanggallahir;
            ?>
        </p>
        <p><strong>Hobi:</strong>
            <?php
                echo $hobi;
            ?>
        </p>
        <p><strong>Pasangan:</strong>
            <?php
                echo $pasangan;
            ?>
        </p>
        <p><strong>Pekerjaan:</strong>
            <?php
                echo $pekerjaan;
            ?>
        </p> 
        <P><strong>Nama Orang Tua:</strong>
            <?php
                echo $nama_orang_tua;
            ?>
        </P>
        <P><strong>Nama Adek:</strong>
            <?php
             echo $nama_adek;
            ?>
        </P>
        </section>

        <section id="ipk">
            <h2>Nilai Saya</h2>

            <?php
            // Data Mata Kuliah
            $namaMatkul1 = "Algoritma dan Struktur Data";
            $namaMatkul2 = "Agama";
            $namaMatkul3 = "Kalkulus";
            $namaMatkul4 = "Bahasa Inggris";
            $namaMatkul5 = "Pemrograman Web Dasar";

            $sksMatkul1 = 4;
            $sksMatkul2 = 2;
            $sksMatkul3 = 4;
            $sksMatkul4 = 3;
            $sksMatkul5 = 3;

            $nilaiHadir1 = 100; $nilaiTugas1 = 60; $nilaiUTS1 = 80; $nilaiUAS1 = 85;
            $nilaiHadir2 = 100; $nilaiTugas2 = 98; $nilaiUTS2 = 95; $nilaiUAS2 = 100;
            $nilaiHadir3 = 100; $nilaiTugas3 = 65; $nilaiUTS3 = 75; $nilaiUAS3 = 78;
            $nilaiHadir4 = 100; $nilaiTugas4 = 60; $nilaiUTS4 = 95; $nilaiUAS4 = 97;
            $nilaiHadir5 = 69; $nilaiTugas5 = 80; $nilaiUTS5 = 90; $nilaiUAS5 = 100;

            // Fungsi Perhitungan 
            function hitungNilaiAkhir($hadir, $tugas, $uts, $uas) {
                return (0.1 * $hadir) + (0.2 * $tugas) + (0.3 * $uts) + (0.4 * $uas);
            }

            function tentukanGrade($nilaiAkhir, $hadir) {
                if ($hadir < 70) return "E";
                elseif ($nilaiAkhir >= 85) return "A";
                elseif ($nilaiAkhir >= 80) return "A-";
                elseif ($nilaiAkhir >= 75) return "B+";
                elseif ($nilaiAkhir >= 70) return "B";
                elseif ($nilaiAkhir >= 65) return "B-";
                elseif ($nilaiAkhir >= 60) return "C+";
                elseif ($nilaiAkhir >= 55) return "C";
                elseif ($nilaiAkhir >= 50) return "C-";
                elseif ($nilaiAkhir >= 45) return "D";
                else return "E";
            }

            function konversiMutu($grade) {
                switch ($grade) {
                    case "A": return 4.00;
                    case "A-": return 3.70;
                    case "B+": return 3.30;
                    case "B": return 3.00;
                    case "B-": return 2.70;
                    case "C+": return 2.30;
                    case "C": return 2.00;
                    case "C-": return 1.70;
                    case "D": return 1.00;
                    default: return 0.00;
                }
            }

            function statusKelulusan($grade) {
                return in_array($grade, ["A", "A-", "B+", "B", "B-", "C+", "C", "C-"]) ? "Lulus" : "Gagal";
            }

            // Hitung Semua Nilai
            $totalBobot = 0;
            $totalSKS = 0;

            for ($i = 1; $i <= 5; $i++) {
                ${"nilaiAkhir$i"} = hitungNilaiAkhir(${"nilaiHadir$i"}, ${"nilaiTugas$i"}, ${"nilaiUTS$i"}, ${"nilaiUAS$i"});
                ${"grade$i"} = tentukanGrade(${"nilaiAkhir$i"}, ${"nilaiHadir$i"});
                ${"mutu$i"} = konversiMutu(${"grade$i"});
                ${"bobot$i"} = ${"mutu$i"} * ${"sksMatkul$i"};
                ${"status$i"} = statusKelulusan(${"grade$i"});
                $totalBobot += ${"bobot$i"};
                $totalSKS += ${"sksMatkul$i"};
            }

            $IPK = $totalBobot / $totalSKS;
            ?>

            <div class="nilai-container">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <p><strong>Nama Matakuliah ke-<?= $i; ?></strong> : <?= ${"namaMatkul$i"}; ?></p>
                    <p><strong>SKS</strong> : <?= ${"sksMatkul$i"}; ?></p>
                    <p><strong>Kehadiran</strong> : <?= ${"nilaiHadir$i"}; ?></p>
                    <p><strong>Tugas</strong> : <?= ${"nilaiTugas$i"}; ?></p>
                    <p><strong>UTS</strong> : <?= ${"nilaiUTS$i"}; ?></p>
                    <p><strong>UAS</strong> : <?= ${"nilaiUAS$i"}; ?></p>
                    <p><strong>Nilai Akhir</strong> : <?= number_format(${"nilaiAkhir$i"}, 2); ?></p>
                    <p><strong>Grade</strong> : <?= ${"grade$i"}; ?></p>
                    <p><strong>Angka Mutu</strong> : <?= number_format(${"mutu$i"}, 2); ?></p>
                    <p><strong>Bobot</strong> : <?= number_format(${"bobot$i"}, 2); ?></p>
                    <p><strong>Status</strong> : <?= ${"status$i"}; ?></p>
                    <hr>
                <?php } ?>

                <p><strong>Total Bobot</strong> : <?= number_format($totalBobot, 2); ?></p>
                <p><strong>Total SKS</strong> : <?= $totalSKS; ?></p>
                <p><strong>IPK</strong> : <?= number_format($IPK, 2); ?></p>
            </div>
        </section>

        <section id="contact">
            <h2>Kontak Kami</h2>
                <form action="" method="GET" novalidate> 
                    <label for="txtNama"><span>Nama:</span> 
                        <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required 
                autocomplete="name"> 
                    </label> 
                    <label for="txtEmail"><span>Email:</span> 
                        <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required 
                autocomplete="email"> 
                    <label for="txtPesan"><span>Pesan Anda:</span> 
                        <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea> 
                        <small id="charCount">0/200 karakter</small> 
                    </label> 
                    <button type="submit">Kirim</button> 
                    <button type="reset">Batal</button>
                </form>
        </section>
    </main> 
 
    <footer> 
        <p>&copy; 2025 Hendy Junior Pereslin [2511500028]</p> 
    </footer> 

    <script src="script.js"></script>
</body> 
 
</html> 