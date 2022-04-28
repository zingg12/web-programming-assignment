<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    
include 'config.php';
if ($_POST) {
    $sql = "INSERT INTO user (user_name, user_address) VALUES ('{$_POST['user_name']}', '{$_POST['user_address']}')";
    $query = mysqli_query($koneksi, $sql);

    if($query)  {
        echo "Data Berhasil Disimpan";
    } else {
        echo "Data Gagal Disimpan".mysqli_error();
    }
}
    $sql = "SELECT * FROM user";
    $query = mysqli_query($koneksi, $sql);
?>
<div class="container">
    <div class="card mt-3">
	    <div class="card-header bg-info text-white">
	        Tambah Data User
	    </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="user_name">Nama</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" required>
                </div>
            <br>
                <div class="form-group">
                    <label for="user_address">Alamat</label>
                    <input type="text" class="form-control" id="user_address" name="user_address" required>
                </div>
                <br>
            <div class="form-group">
                <label for="user_gambar">Masukkan Gambar</label><br>
                <input type="file" id="user_gambar" name="user_gambar">
            </div>
        
            <a class="btn btn-primary float-right ml-2" href="index.php" role="button">Home</a>
            <input class="btn btn-success float-right" type="submit" value="Submit">
        </div>
    </div>    
        <br>
        <br>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Kelola Data</th>
                </tr>
            </thead>
                <?php
                while($data = mysqli_fetch_array($query)) {
                    ?>
                <tbody>
                    <tr>
                        <td><?php echo $data['user_id'] ?></td>
                        <td><?php echo $data['user_name'] ?></td>
                        <td><?php echo $data['user_address'] ?></td>
                        <td><?php echo $data['user_gambar'] ?></td>
                        <td class="action">
                            <a class="btn btn-secondary btn-sm" href="edit_user.php?id=<?= $data['user_id'] ?>" role="button">Edit</a>
                            <a class="btn btn-danger btn-sm" href="hapus_user.php?id=<?= $data['user_id'] ?>" role="button">Hapus</a>
                        </td>
                    </tr>
                </tbody>
                <?php
                }
                ?>
            </table>
        </form>
</div>
