<?php 
$conn = new mysqli("localhost","root","","mandiri");
function query($query) {
    global $conn;
    $data = [];
    $result = $conn -> query($query);
    // if($result -> num_rows == 0 ) {
    //     echo "data ,masih kosong";
    // } else {
    //     echo "data ditemukan";
    // }
    while($res = $result -> fetch_assoc()) {
        array_push($data,$res);
    };

    return $data;

}

function insert($data,$files) {
    global $conn;
    
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $assets = upload($files);

    $cekData = query("SELECT * FROM mahasiswa WHERE nama = '$nama'");

    if(count($cekData) > 0) {
        echo"
            <script>
            alert('nama telah terdaftar');
            </script>
            ";

        return false;
    }

    if(strlen($nim) > 6 && strlen($nim) < 6 ) {
        echo"
            <script>
            alert('nim harus 6 karakter karakter');
            </script>
            ";

        return false;

    }

    if(!$assets) {
        return false;
    }
    
    $conn -> query("INSERT INTO mahasiswa(nama,nim,jurusan,assets)
                VALUES('$nama','$nim','$jurusan','$assets')");


    return $conn -> affected_rows;
};

function upload($files){
    $namaFile=$files["assets"]["name"];
    $size = $files["assets"]["size"];
    $tempName = $files["assets"]["tmp_name"];
    $error = $files["assets"]["error"];

    if($error === 4) {
        echo "
            <script>
            alert('anda tidak mengirim gambar');
            </script>
            ";
            return false;
    }
    $extension = ["jpg","png","webp","jpeg"];
    $eksplode = explode(".",$namaFile);
    $eksGambar = strtolower(end($eksplode));

    if(!in_array($eksGambar,$extension)) {
        echo "
            <script>
            alert('ektension harus jpg,jpeg,webp,png);
            </script>
            ";

            return false;
    }

    if($size > 2000000) {
        echo"
            <script>
            alert('ukuran file harus dibawah 2 mb
            </script
            ";

            return false;
            
    }

    $namabaru = uniqid();
    $namabaru .= ".";
    $namabaru .= $eksGambar;
    move_uploaded_file($tempName,"./img/$namabaru");

    return $namabaru;



};

function update($id,$data,$files) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $assets='';

    if(strlen($nim) > 6) {
        echo"
            <script>
            alert('nim harus dibawah 7 karakter')
            </script>
            ";

        return false;

    }

    if($files["assets"]["error"] == 4) {
        $gambar = getById($id);
        $assets=$gambar["assets"];
    } else {
        $assets = upload($files);
    };

    $conn -> query("UPDATE mahasiswa
                    SET nama = '$nama',
                     nim = '$nim',
                     jurusan = '$jurusan',
                     assets = '$assets'
                    WHERE id=$id
                    ;"
                    );

    return $conn -> affected_rows;

    
}

function getById($id) {
    global $conn;

    $result = $conn -> query("SELECT * FROM mahasiswa WHERE id = $id");
    $response = $result -> fetch_assoc();

    return $response;
}



function hapus($id) {
    global $conn;

    $conn -> query("DELETE FROM mahasiswa WHERE id = $id");

    return $conn -> affected_rows; 
}

 ?>