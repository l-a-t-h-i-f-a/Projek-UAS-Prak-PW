<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<?php


// include database connection file
include("config.php");

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{
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
    include_once("config.php");
    // update user data
    $result = mysqli_query($koneksi, "UPDATE users SET nama='$nama', username='$username', password='$password', foto='$foto' WHERE id=$id");


    // Redirect to homepage to display updated user in list
   
    echo "User added successfully. <a href='index.php?url=user'>View User</a>";
}
?>
<?php
// Display selected user data based on id
// Getting id from url
if (isset($_GET['id'])) {
$id = $_GET['id'];

// Fetch user data based on id
$result = mysqli_query($koneksi, "SELECT * FROM users WHERE id=$id");

 if ($result && mysqli_num_rows($result) > 0) {
  while($user_data = mysqli_fetch_array($result))
{   
   $id= $user_data['id'];
    $nama= $user_data['nama'];
    $username= $user_data['username'];
    $password= $user_data['password'];
    $foto = $user_data['foto'];
}
}
}


?>

<form action="edit_user.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" aria-describedby="emailHelp" >
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" >
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" >

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" >

        </div>
        <div class="mb-3">
          <label for="formFileSm" class="form-label">Foto</label>
          <input class="form-control" type="file" id="formFile"  name="berkas" >
      </div>

      <button type="Submit" name="update" class="btn btn-primary">Submit</button>
      <a href="index.php?url=user" class="btn btn-danger btn-icon-split">
        <span class="text">Cancel</span>
    </a>
    
</form>
        