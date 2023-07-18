<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<form action="tambah_user.php" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Id</label>
    <input type="text" class="form-control" name="id" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Nama</label>
    <input type="text" class="form-control" name="nama">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="text" class="form-control" name="password">
  </div>
  <div class="mb-3">
  <label for="formFile" class="form-label">Foto</label>
  <input type="file" name="berkas" />
</div>
  <button type="Submit" name="Submit" class="btn btn-primary">Submit</button>
  <a href="index.php?url=user" class="btn btn-danger btn-icon-split">
    <span class="text">Cancel</span>
  </a>
</form>
<?php

// Check If form submitted, insert form data into users table.
if(isset($_POST['Submit'])) {
    $id= $_POST['id'];
    $nama= $_POST['nama'];
    $username = $_POST['username'];
    $password= $_POST['password'];
    $foto= $_FILES['berkas']['name'];
    $namaFile = $_FILES['berkas']['name'];
    $namaSementara = $_FILES['berkas']['tmp_name'];

    // tentukan lokasi file akan dipindahkan
    $dirUpload = "upload/";

    // pindahkan file
    $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

    if ($terupload) {
        echo "Upload berhasil!<br/>";
        echo "Link: <a href='".$dirUpload.$namaFile."'>".$namaFile."</a>";
    } else {
        echo "Upload Gagal!";
    }

    // include database connection file
    include_once("config.php");

    // Insert user data into table
    $result= mysqli_query($koneksi, "INSERT INTO users(id,nama,username,password,foto) VALUES('$id','$nama','$username','$password', '$foto')");

    // Show message when user added
    echo "User added successfully. <a href='index.php?url=user'>View Data User</a>";
}
?>