<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Data Kehadiran</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Tambah Data Kehadiran</h2>

<form action="" method="post" enctype="multipart/form-data">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>NIM:</label><br>
    <input type="text" name="nim" required><br><br>

    <label>Program Studi:</label><br>
    <input type="text" name="prodi" required><br><br>

    <label>Jam Hadir:</label><br>
    <input type="datetime-local" name="jam_hadir" value="<?= date('Y-m-d\TH:i'); ?>"><br><br>

    <label>Foto Kehadiran:</label><br>
    <input type="file" name="foto" required><br><br>

    <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Jika user tidak memilih jam hadir, ambil waktu server
    if (!empty($_POST['jam_hadir'])) {
        $jam_hadir = $_POST['jam_hadir'];
    } else {
        $jam_hadir = date('Y-m-d H:i:s');
    }

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $path = "uploads/" . $foto;

    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO mahasiswa (nama, nim, prodi, jam_hadir, foto) 
                  VALUES ('$nama', '$nim', '$prodi', '$jam_hadir', '$foto')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data berhasil disimpan!');window.location='index.php';</script>";
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal upload foto.";
    }
}
?>
</body>
</html>
