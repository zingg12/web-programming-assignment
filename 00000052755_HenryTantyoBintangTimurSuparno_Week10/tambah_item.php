<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    
include 'config.php';''
?>
<div class="container">
    <div class="card mt-3">
            <div class="card-header bg-info text-white">
                Edit Data Item
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="item_name">Nama Item</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" required>
                    </div>
                <br>
                    <div class="form-group">
                        <label for="item_description">Description</label>
                        <input type="text" class="form-control" id="item_description" name="item_description" required>
                    </div>
                <br>
                    <div class="form-group">
                        <label for="user_id">User ID</label>
                        <select class="form-control" id="user_id" name="user_id">
                        <option>-Pilih-</option>
                        <?php
                        include 'config.php';
                        $query = mysqli_query($koneksi, "SELECT * FROM user");
                        while($data = mysqli_fetch_array($query)){
                            echo "<option value=$data[user_id] - $data[user_name] >  $data[user_name] </option>";
                        }
                        ?>
                    </select>
                <br>
                <a class="btn btn-primary btn-sm float-right ml-2" href="index.php" role="button">Home</a>
                <input class="btn btn-success btn-sm float-right" type="submit" value="Submit">
                <br>
                <?php
                if ($_POST) {
                    $sql = "INSERT INTO item (item_id, item_name, item_description, user_id) VALUES (NULL, '{$_POST['item_name']}', '{$_POST['item_description']}', '{$_POST['user_id']}')";
                    $query = mysqli_query($koneksi, $sql);

                    if($query)  {
                        echo "Data Berhasil Disimpan";
                    } else {
                        echo "Data Gagal Disimpan".mysqli_error();
                    }
                }
                $sql = "SELECT * FROM user INNER JOIN item ON user.user_id=item.user_id";
                $query = mysqli_query($koneksi, $sql);
                    ?>
            </div>
    </div>
</div>
<br>
<table class="table table-hover">
    <thead class="thead-dark">  
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Description</th>
            <th>User Name</th>
            <th>Kelola</th>
        </tr>
    </thead>
        <?php
        while($data = mysqli_fetch_array($query)) {
            ?>
    <tbody>
        <tr>
            <td><?php echo $data['item_id'] ?></td>
            <td><?php echo $data['item_name'] ?></td>
            <td><?php echo $data['item_description'] ?></td>
            <td><?php echo $data['user_name'] ?></td>
            <td>
                <a class="btn btn-secondary btn-sm" href="edit_item.php?id=<?= $data['item_id'] ?>" role="button">Edit</a>  
                <a class="btn btn-danger btn-sm" href="hapus_item.php?id=<?= $data['item_id'] ?>" role="button">Hapus</a>
            </td>
        </tr>
    </tbody>
        <?php
        }
        ?>
    </table>
</form>
</div>