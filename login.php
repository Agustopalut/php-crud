<?php
session_start();
require './controller/functions.php';

// cek cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];
    $result = query("SELECT * FROM user WHERE id = $id");

    if (count($result) === 0) {
        echo "error";
        die;
    }

    if ($key === hash('sha256', $result[0]["username"])) {
        $_SESSION["id"] = $result[0]["id"];
    }
}


if (isset($_SESSION["id"])) {
    header('Location:index.php');
    die;
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = query("SELECT * FROM user WHERE email ='$email';");
    if (count($result) == 0) {
        $error = 'email tidak ditemukan';
    } else {
        if (!password_verify($password, $result[0]["password"])) {
            $error = "password salah";
        } else {
            if (isset($_POST["remember"])) {
                // jika mengirim remember;
                setcookie('id', $result[0]["id"]);
                setcookie('key', hash('sha256', $result[0]["username"]), time() + 60 + 120);
            }
            $_SESSION["id"] = $result[0]["id"];
            header("Location:index.php");
        }
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
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="box-container">
            <form action="" method="post">
                <?php if (isset($error)) : ?>
                    <p><?php echo $error; ?></p>
                <?php endif; ?>
                <ul>
                    <li>
                        <label for="email">email :</label><br>
                        <input type="email" class="form-control" autocomplete="off" name="email" id="email">
                    </li>
                    <li>
                        <label for="password">password : </label><br>
                        <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                    </li>
                    <li>
                        <label for="remember">remember me :</label><br>
                        <input type="checkbox" name="remember" id="remember">
                    </li>
                    <li>
                        <button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
                    </li>
                </ul>
            </form>
            <p>belum punya akun? <a class="text-primary" href="register.php">sign up sekarang</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>