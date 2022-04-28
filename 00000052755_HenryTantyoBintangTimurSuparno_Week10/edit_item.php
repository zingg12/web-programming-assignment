<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
include 'config.php';

$id = (int) $_GET['id'];
$sql = "SELECT * FROM item WHERE item_id='$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
?>
<div class="container">
    <div class="card mt-3">
	  <div class="card-header bg-info text-white">
	    Edit Data Item
	  </div>
	  <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $data['item_id'] ?>">
                    <label for="item_name">Nama Item</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" value="<?= $data['item_name'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="item_description">Description</label>
                    <input type="text" class="form-control" id="item_description" name="item_description" value="<?= $data['item_description'] ?>" required>
                </div>
                <div class="form-group">
                        <label for="user_id">User ID</label>
                        <select class="form-control" id="user_id" name="user_id">
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM user");
                        while($data = mysqli_fetch_array($query)) :
                            if($data['user_id'] == $user_id){
                                $selected = 'selected = "selected"';
                            } else {
                                $selected = '';
                            }
                        ?>
                        <option <?= $selected ?>value="<?= $data['user_id'] ?>"><?= $data['user_name'] ?></option>
                        <?php endwhile ?>
                    </select>
                <br>
                <a class="btn btn-danger btn-sm float-right ml-2" href="tambah_item.php" role="button">Back</a>
                <input class="btn btn-success btn-sm float-right" type="submit" value="Submit">
            </form>

            <?php
            if ($_POST) {
                $sql = "UPDATE item SET item_name='{$_POST['item_name']}', item_description='{$_POST['item_description']}', user_id='{$_POST['user_id']}' WHERE item.item_id='{$_POST['id']}'";
                $query = mysqli_query($koneksi, $sql);


                if ($query) {
                    header('Location: tambah_item.php');
                } else {
                    echo "Data Gagal di Edit: ".mysqli_error();
                }
            }
            ?>
        </div>
    </div>
</div>