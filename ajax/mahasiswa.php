<?php
require '../controller/functions.php';

$halamanAktif=1;
if (isset($_GET["keyword"]) && $_GET["keyword"] !== '') {
    $keyword = $_GET["keyword"];
    $mahasiswa = query("SELECT * FROM mahasiswa
            WHERE
            nama LIKE '%$keyword%' OR
            nim LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ;");
} else {
    $dataPerHalaman = 3;
    $totalData = count(query("SELECT * FROM mahasiswa"));
    $totalHalaman = ceil($totalData / $dataPerHalaman);
    $halamanAktif = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
    $dataAwal = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;

    $mahasiswa  = query("SELECT * FROM mahasiswa LIMIT $dataAwal,$dataPerHalaman");
}
?>
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