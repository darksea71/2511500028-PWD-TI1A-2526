<!DOCTYPE html> 
<html lang="id"> 
 
<head> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>Pertemuan 2</title>
<link rel="stylesheet" href="style.css">
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
        echo "nama saya hendy";
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
                $nama_adek = "Cella"
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