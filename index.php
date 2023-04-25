<?php
session_start();
require './controller/functions.php';

if (!isset($_SESSION["id"])) {

    header("Location:login.php");

    die;
}

$dataPerHalaman = 3;
$totalData = count(query("SELECT * FROM mahasiswa"));
$totalHalaman = ceil($totalData / $dataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
$dataAwal = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;

$mahasiswa  = query("SELECT * FROM mahasiswa LIMIT $dataAwal,$dataPerHalaman");

// if($conn -> connect_errno) {
//     echo "failed connection";
// } else {
//     echo "connection succesfully";
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>daftar mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="container">
    <h1>Daftar Mahasiswa</h1>
    <div class="flex align-items-center p-2">
        <a href="logout.php" class="btn btn-dark">Logout</a>
        <a class="mt-2 mb-3 btn btn-primary" href="add.php">add mahasiswa</a>
        <a class="btn btn-warning" href="cetak.php" target="_blank">cetak pdf</a>
    </div>
    <input type="text" class="form-control mt-3 mb-3 w-50" id="keyword">
    <div id="container-table">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>no</td>
                    <td>nama</td>
                    <td>nim</td>
                    <td>jurusan</td>
                    <td>assets</td>
                    <td>actions</td>
                </tr>
            </thead>
            <tbody>
                <?php if (count($mahasiswa) > 0) : ?>
                    <?php foreach ($mahasiswa as $index => $siswa) : ?>

                        <tr>
                            <td><?php echo $index + 1 ?></td>
                            <td><?php echo $siswa["nama"]; ?></td>
                            <td><?php echo $siswa["nim"]; ?></td>
                            <td><?php echo $siswa["jurusan"]; ?></td>
                            <td>
                                <img src="img/<?php echo $siswa["assets"]; ?>" width="50px" height="50px" alt="">
                            </td>
                            <td>
                                <a href="update.php?id=<?php echo $siswa["id"]; ?>" class="btn btn-success">update</a>
                                <a onclick="return confirm('anda yakin ingin menghapus?')" href="hapus.php?id=<?php echo $siswa["id"]; ?>" class="btn btn-danger">hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" align="center" class="text-primary">Data masih kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation example" id="pagination">
        <ul class="pagination">
            <?php if ($halamanAktif > 1) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halamanAktif - 1 ?>">Previous</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalHalaman; $i++) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php endfor; ?>
            <?php if ($halamanAktif < $totalHalaman) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halamanAktif + 1 ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <script src="jquery/jquery.js"></script>
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>