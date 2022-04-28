<?php
session_start();

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

include 'config.php';

function registrasi($data) {
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $konfirmasi = mysqli_real_escape_string($koneksi, $data["konfirmasi"]);


    //cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM username WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar')
                </script>";
        return false;
    }

    if($password !== $konfirmasi){
        echo "<script>
            alert('konfirmasi password tidak sesuai');
            </script>";
        return false;
    }
    
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //insert ke database
    mysqli_query($koneksi, "INSERT INTO username VALUES('', '$username', '$password')" );
     return mysqli_affected_rows($koneksi);
}

if(isset($_POST["register"])){

    if( registrasi($_POST) > 0 ){
        echo "<script>
                alert('user baru berhasil ditambahkan');
            </script>";

            header("Location: index.php");
    } else{
        echo mysqli_error($koneksi);
    }
}

?>
<!DOCTYPE html> 
<html>
<head>
    <title>Halamas Registrasi</title>
</head>
<body>
<div class="container">    
    <div class="card mt-3">
        <div class="card-header bg-info text-white">
            Registrasi
        </div>
        <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="username">username</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="konfirmasi">konfirmasi password</label>
                <input type="password" class="form-control" name="konfirmasi" id="konfirmasi" required>
            </div>
                <input class="btn btn-success btn-sm float-right" type="submit" name="register" href="login.php" value="Submit">
                <a class="btn btn-primary btn-sm float-right mr-2" href="login.php" role="button">Login</a>
        </form>
    </div>
</div>
</body>
</html>