<?php
include 'config.php';
$id = $_GET['id'];

// hapus file foto juga
$getFoto = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM mahasiswa WHERE id=$id"));
if ($getFoto['foto'] != '' && file_exists('uploads/'.$getFoto['foto'])) {
    unlink('uploads/'.$getFoto['foto']);
}

mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id=$id");
echo "<script>alert('Data berhasil dihapus!');window.location='index.php';</script>";
?>
