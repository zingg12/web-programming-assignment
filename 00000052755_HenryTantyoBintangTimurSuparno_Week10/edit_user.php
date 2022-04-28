<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    
include 'config.php';

$id = (int) $_GET['id'];
$sql = "SELECT * FROM user WHERE user_id='$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
?>
<div class="container">
    <div class="card mt-3">
	    <div class="card-header bg-info text-white">
	        Edit Data User
	    </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $data['user_id'] ?>">
                    <label for="user_name">Nama</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="<?= $data['user_name'] ?>" required>
                </div>
            <br>
                <div class="form-group">
                    <label for="user_address">Alamat</label>
                    <input type="text" class="form-control" id="user_address" name="user_address" value="<?= $data['user_address'] ?>" required>
                </div>
            <a class="btn btn-danger btn-sm float-right ml-2" href="tambah_user.php" role="button">Back</a>
            <input class="btn btn-success btn-sm float-right" type="submit" value="Submit">
            </form>
        </div>
    </div>
    <?php
    if ($_POST) {
        $sql = "UPDATE user SET user_name='{$_POST['user_name']}', user_address='{$_POST['user_address']}' WHERE user_id='{$_POST['id']}'";
        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            header('Location: tambah_user.php');
        } else {
            echo "Data Gagal di Edit: ".mysqli_error();
        }
    }
    ?>
</div>