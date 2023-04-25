<?php 
require './controller/functions.php';

$id = $_GET["id"];
$mahasiswa = query("SELECT * FROM mahasiswa where id=$id");

if(isset($_POST["submit"])) {
    if(update($id,$_POST,$_FILES) > 0) {
        echo "
            <script>
            alert('data berhasil di update');
            document.location.href='index.php';
            </script>
            ";

    } else {
        echo  "
            <script>
            alert('data gagal di update');
            document.location.href='update.php?id=$id';
            </script>
            ";
    }
}


 ?>
<?php  
session_start();
if(!isset($_SESSION["id"])) {
    header('Location:login.php');
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container-fluid">
        <div class="box-container">
            <h1>update <?php echo $mahasiswa[0]["nama"]; ?> </h1>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="name">name : </label>
                <input type="text" name="nama" autocomplete="off" value="<?= $mahasiswa[0]["nama"]; ?>" class="form-control" id="name">
                <label for="nim" class="mt-3">nim : </label>
                <input type="text" names="nim"  id="nim" class="form-control" value="<?= $mahasiswa[0]["nim"]; ?>" name="nim" autocomplete="off">
                <label for="jurusan" class="mt-3">jurusan :</label>
                <input type="text" class="form-control" name="jurusan" id="jurusan" value="<?= $mahasiswa[0]["jurusan"]; ?>" name="jurusan"  autocomplete="off">
                <label for="assets">assets :</label>
                <input type="file" class="form-control mt-3" name="assets" id="assets">
                <img src="img/<?= $mahasiswa[0]["assets"]; ?>" class="mt-3 " width="100px" height="90px" alt="">
                <button class="btn btn-primary mt-3 w-100" name="submit">submit</button>
            </form>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>