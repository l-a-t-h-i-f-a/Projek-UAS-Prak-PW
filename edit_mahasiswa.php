<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<?php


// include database connection file
include("config.php");

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{
    $nim= $_POST['nim'];
    $nama= $_POST['nama'];
    $prodi = $_POST['prodi'];
    $alamat= $_POST['alamat'];
    $foto= $_FILES['berkas']['name'];
    $namaFile = $_FILES['berkas']['name'];
    $namaSementara = $_FILES['berkas']['tmp_name'];
    // tentukan lokasi file akan dipindahkan
    $dirUpload = "uploads/";

// pindahkan file
    $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

    if ($terupload) {
        echo "Upload berhasil!<br/>";
        echo "Link: <a href='".$dirUpload.$namaFile."'>".$namaFile."</a>";
    } else {
        echo "Upload Gagal!";
    }
    include_once("config.php");
    // update user data
    $result = mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', prodi='$prodi', alamat='$alamat', foto='$foto' WHERE nim=$nim");


    // Redirect to homepage to display updated user in list
   
    echo "User added successfully. <a href='index.php?url=mahasiswa'>View Mahasiswa</a>";
}
?>
<?php
// Display selected user data based on id
// Getting id from url
if (isset($_GET['nim'])) {
$nim = $_GET['nim'];

// Fetch user data based on id
$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim=$nim");

 if ($result && mysqli_num_rows($result) > 0) {
  while($user_data = mysqli_fetch_array($result))
{   
   $nim= $user_data['nim'];
    $nama= $user_data['nama'];
    $prodi= $user_data['prodi'];
    $alamat= $user_data['alamat'];
    $foto = $user_data['foto'];
}
}
}


?>

<form action="edit_mahasiswa.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nim</label>
            <input type="text" class="form-control" name="nim" aria-describedby="emailHelp" >
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" >
        </div>

        <?php 
        include_once("config.php");
        $sql = mysqli_query($koneksi, "SELECT * FROM  prodi ORDER BY id ASC");
        ?>
        <div class="mb-3">
          <label class="form-label">Pilih Prodi</label>
          <select class="form-control" name="prodi">
            <option>Prodi</option>
            <?php
                // use a while loop to fetch data
                // from the $all_categories variable
                // and individually display as an option
            while ($category = mysqli_fetch_array(
                $sql,MYSQLI_ASSOC)):;
                ?>
                <option value="<?php echo $category["id"];?>">
                    <?php echo $category["nama_prodi"];?>  
                    <?php
                endwhile; ?>
            </select>
        </div>


        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="3"></textarea>

        </div>
        <div class="mb-3">
          <label for="formFileSm" class="form-label">Foto</label>
          <input class="form-control" type="file" id="formFile"  name="berkas" >
      </div>

      <button type="Submit" name="update" class="btn btn-primary">Submit</button>
      <a href="index.php?url=mahasiswa" class="btn btn-danger btn-icon-split">
        <span class="text">Cancel</span>
    </a>
    
</form>
        