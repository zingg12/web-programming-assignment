<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    include 'config.php';
    $sql = "SELECT * FROM user INNER JOIN item ON user.user_id=item.user_id";
    $query = mysqli_query($koneksi, $sql);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Henry Tantyo Bintang Timur Suparno</title>
</head>
<body>
<div class="container">
    <div class="button mt-3 mb-3 float-left">
        <a class="btn btn-danger btn-sm" href="logout.php" role="button">Logout</a>
    </div>
    <div class="button mt-3 mb-3 float-right">
        <a class="btn btn-primary" href="tambah_user.php" role="button">Tambah User</a>
        <a class="btn btn-primary" href="tambah_item.php" role="button">Tambah Item</a>
    </div>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Item</th>
                <th>Description</th>
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
                <td><?php echo $data['item_name'] ?></td>
                <td><?php echo $data['item_description'] ?></td>
            </tr>
        </tbody>
        <?php
        }
        ?>
    </table>
</div>
</body>
</html>