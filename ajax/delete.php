<?php
require("../lib/config.php");

    if (isset($_GET['id'])) {
        $post_id = $db->real_escape_string(filter($_GET['id']));
        $cek_id = mysqli_query($db, "SELECT * FROM mhsw WHERE id = '$post_id'");
        $db_id = mysqli_fetch_assoc($cek_id);
        if (mysqli_num_rows($cek_id) == 0) {
            header("Location: ".$config['url']);
        }
?>
        <span id="getTitle" title-modal="Delete Mahasiswa"></span>
        <form role="form" method="POST">
			<input type="hidden" name="id" class="form-control" value="<?php echo $db_id['id']; ?>" readonly>
            <style>
                input[readOnly] { background: transparent !important; }
                textarea[readOnly] { background: transparent !important; }
            </style>
            <div class="form-group">
                <label class="form-control-label">Nama Lengkap</label>
                <input type="text" class="form-control" value="<?php echo $db_id['nama']; ?>" readonly>
            </div>
            <button type="submit" class="btn btn-danger btn-block" name="delete">Delete Mahasiswa</button>
        </form>
<?php
} else {
    header("Location: ".$config['url']);
}
?>