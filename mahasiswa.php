
<?php

include_once("config.php");


$result = mysqli_query($koneksi, "SELECT * FROM  mahasiswa INNER JOIN prodi ON prodi.id=mahasiswa.prodi");

?>

<html>
<head>
    <title>Data User</title>
</head>

<body>
<b>Data Mahasiswa</b><br>
<a href="?url=tambah_mahasiswa" class="btn btn-primary btn-icon-split">
    <span class="text">Tambah Data</span>
</a><br><br>


 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <tr>
        <th>Nim</th><th>Nama</th> <th>Prodi</th> <th>Alamat</th> <th>Foto</th> <th>Aksi</th>
    </tr>
    <?php
    $i=1;
    while($user_data = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$user_data['nim']."</td>";
        echo "<td>".$user_data['nama']."</td>";
        echo "<td>".$user_data['nama_prodi']."</td>";
        echo "<td>".$user_data['alamat']."</td>";
        echo "<td><img src='uploads/$user_data[foto]' width='90' height='110' /></td>";
        echo "<td><a href='edit_mahasiswa.php?nim=$user_data[nim]'>Edit</a> | <a href='hapus_mahasiswa.php?nim=$user_data[nim]'>Delete</a></td></tr>";
   
    }
    ?>
</table>
</div>
</div>
</div>
</div>
</body>

</html>
