<?php
session_start();
require './controller/functions.php';

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    // $regex = "/<>[a-z]/i";
    $getUser = query("SELECT * FROM user WHERE 
                username ='$username'OR
                email = '$email';
                ");
    if (count($getUser) > 0) {
        $error = 'user telah terdafatar';
        die;
    }
    // $hasil = []
    // if (preg_match_all($regex, $username) > 0) {
    //     // jika terdapat string yang tidak diizinkan;
    //     $error = "masukan username yang benar";
    // }

    if ($password !== $_POST["confirm"]) {
        $error = "password dan confirm password tidak cocok";
        die;
    }

    $hashpassword = password_hash($password, PASSWORD_DEFAULT);

    $conn->query("INSERT INTO user(username,email,password)
                VALUES('$username','$email','$hashpassword')");

    if ($conn -> affected_rows > 0 ) {
         echo "
            <script>
            alert('user berhasil terdaftar')
            document.location.href = 'login.php';
            </script>
            ";
        // header("Location:index.php");
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
    <title>register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="box-container">
            <h1>Register </h1>
            <form action="" method="post">
                <?php if(isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <p><?php echo $error; ?></p>
                </div>
                <?php endif; ?>
                
                <label for="username">username : </label>
                <input type="text" name="username" autocomplete="off" class="form-control" id="username" required>
                <label for="email">email : </label>
                <input type="email" name="email" autocomplete="off" class="form-control" id="email" required>
                <label for="password" class="mt-3">password : </label>
                <input type="password" placeholder="******" id="password" class="form-control" name="password" autocomplete="off">
                <label for="confirmPassowrd" class="mt-3">confirm password :</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm" placeholder="******" autocomplete="off" required>
                <button class="btn btn-primary mt-3 w-100" name="submit">submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>