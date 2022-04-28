<?php
session_start();

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

include 'config.php';

    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($koneksi, "SELECT * FROM username WHERE username = '$username'");

        //cek username
        if(mysqli_num_rows($result) === 1){

            //cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])){
                //set session
                $_SESSION["login"] = true;

                header("Location: index.php");
                exit;
            }
        }

        $error = true;
    }

?>

<!DOCTYPE html> 
<html>
<head>
    <title>Halaman Login</title>
</head>
<body>
<div class="container">    
    <div class="card mt-3">
        <div class="card-header bg-info text-white">
            Login
        </div>

<?php if(isset($error)) :?>
    <script>
        alert('Password atau username salah!');
    </script>
    <?php endif; ?>
    
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
                <input class="btn btn-success btn-sm float-right" type="submit" name="login" value="Login">
                <a class="btn btn-primary btn-sm float-right mr-2" href="registrasi.php" role="button">Registrasi</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>