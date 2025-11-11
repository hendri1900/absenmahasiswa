
<?php
include 'config.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id=$id"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data</title>
</head>
<body>
<h2>Edit Data Kehadiran</h2>

<form action="" method="post" enctype="multipart/form-data">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br><br>

    <label>NIM:</label><br>
    <input type="text" name="nim" value="<?= $data['nim']; ?>" required><br><br>

    <label>Program Studi:</label><br>
    <input type="text" name="prodi" value="<?= $data['prodi']; ?>" required><br><br>

    <label>Jam Hadir:</label><br>
    <input type="datetime-local" name="jam_hadir" value="<?= date('Y-m-d\TH:i', strtotime($data['jam_hadir'])); ?>" required><br><br>

    <label>Foto Lama:</label><br>
    <img src="uploads/<?= $data['foto']; ?>" width="80"><br><br>

    <label>Ganti Foto (opsional):</label><br>
    <input type="file" name="foto"><br><br>

    <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $jam_hadir = $_POST['jam_hadir'];

    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "uploads/".$foto);
        $query = "UPDATE mahasiswa SET 
                  nama='$nama', nim='$nim', prodi='$prodi', jam_hadir='$jam_hadir', foto='$foto' 
                  WHERE id=$id";
    } else {
        $query = "UPDATE mahasiswa SET 
                  nama='$nama', nim='$nim', prodi='$prodi', jam_hadir='$jam_hadir' 
                  WHERE id=$id";
    }

    mysqli_query($koneksi, $query);
    echo "<script>alert('Data berhasil diperbarui!');window.location='index.php';</script>";
}
?>
</body>
</html>
