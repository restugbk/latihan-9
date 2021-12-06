<?php
require ("../lib/config.php");

    if (isset($_GET['id'])) {
        $post_id = $db->real_escape_string(filter($_GET['id']));
        $cek_id = mysqli_query($db, "SELECT * FROM mhsw WHERE id = '$post_id'");
        $db_id = mysqli_fetch_assoc($cek_id);
        if (mysqli_num_rows($cek_id) == 0) {
            header("Location: ".$config['url']);
        }
?>
        <span id="getTitle" title-modal="Edit Mahasiswa"></span>
        <form role="form" method="POST">
			<input type="hidden" name="id" class="form-control" value="<?php echo $db_id['id']; ?>" readonly>
            <div class="form-group">
                <label class="form-control-label">NIM</label>
                <input type="number" class="form-control" name="nim" placeholder="Masukkan NIM" inputmode="numeric" value="<?php echo $db_id['nim']; ?>" required autofocus>
            </div>
            <div class="form-group">
                <label class="form-control-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lengkap" value="<?php echo $db_id['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label class="form-control-label">Tanggal Lahir</label>
                <input type="text" class="form-control" name="tgllahir" id="datepicker2" value="<?php echo $db_id['tgllahir']; ?>" autocomplete="off" readonly required>
            </div>
            <div class="form-group">
                <label class="form-control-label">Alamat</label>
                <textarea class="form-control" rows="10" name="alamat" placeholder="Alamat" required><?php echo $db_id['alamat']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-info btn-block" name="edit">Edit Mahasiswa</button>
        </form>
        <script>
        $(function () {
            $('#datepicker2').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
            })
        })
        </script>
<?php
} else {
    header("Location: ".$config['url']);
}
?>