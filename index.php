<?php
include 'config.php';
$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY jam_hadir DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Hadir Mahasiswa</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>📋 Daftar Hadir Mahasiswa</h2>
<a href="tambah.php">+ Tambah Data</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIM</th>
    <th>Prodi</th>
    <th>Jam Hadir</th>
    <th>Foto</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$no++."</td>";
    echo "<td>".$row['nama']."</td>";
    echo "<td>".$row['nim']."</td>";
    echo "<td>".$row['prodi']."</td>";
    echo "<td>".$row['jam_hadir']."</td>";
    echo "<td><img src='uploads/".$row['foto']."' width='80'></td>";
    echo "<td>
            <a href='edit.php?id=".$row['id']."'>Edit</a> | 
            <a href='hapus.php?id=".$row['id']."' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a>
          </td>";
    echo "</tr>";
}
?>
</table>

</body>
</html>
