<?php
require './controller/functions.php';
session_start();
if(!isset($_SESSION["id"])) {
    header('Location:login.php');
    die;
}
if (isset($_POST["submit"])) {
    if (insert($_POST, $_FILES) > 0) {
        echo "
            <script>
            alert('data berhasil dikirim');
            document.location.href ='index.php';
            </script>
            ";
    } else {
        echo "
            <script>
            alert('data gagal dikirim');
            document.location.href ='index.php';
            </script>
            ";
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>add</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="box-container">
            <h1>Tambah mahasiswa </h1>
            <form action="" method="post" enctype="multipart/form-data">
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        terjadi kesalahan
                    </div >
                <?php endif; ?> <label for="name">name : </label>
                    <input type="text" name="nama" autocomplete="off" class="form-control" id="name">
                    <label for="nim" class="mt-3">nim : </label>
                    <input type="text" id="nim" class="form-control" name="nim" autocomplete="off">
                    <label for="jurusan" class="mt-3">jurusan :</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" autocomplete="off">
                    <label for="assets" class="mt-3">assets :</label>
                    <input type="file" class="form-control" id="assets" name="assets" autocomplete="off">

                    <button class="btn btn-primary mt-3 w-100" name="submit">submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>