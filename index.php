<?php
require("lib/config.php");
include('lib/header.php');

if (isset($_POST['add'])) {
    $post_nim = $db->real_escape_string(filter($_POST['nim']));
    $post_nama = $db->real_escape_string(filter($_POST['nama']));
    $post_tgllahir = $db->real_escape_string(filter($_POST['tgllahir']));
    $post_alamat = $db->real_escape_string(filter($_POST['alamat']));

    if (empty($post_nim) || empty($post_nama) || empty($post_tgllahir) || empty($post_alamat)) {
        $msg_type = "error";
        $msg_content = "Semua field tidak boleh kosong.";
    } else {
        $insert_data = mysqli_query($db, "INSERT INTO mhsw (nim, nama, tgllahir, alamat) VALUES ('$post_nim', '$post_nama', '$post_tgllahir', '$post_alamat')");
        if ($insert_data == TRUE) {
            $msg_type = "success";
            $msg_content = "Data berhasil ditambah.";
        } else {
            $msg_type = "error";
            $msg_content = "System error.";
        }
    }
} else if (isset($_POST['edit'])) {
    $post_id = $db->real_escape_string($_POST['id']);
    $post_nim = $db->real_escape_string(filter($_POST['nim']));
    $post_nama = $db->real_escape_string(filter($_POST['nama']));
    $post_tgllahir = $db->real_escape_string(filter($_POST['tgllahir']));
    $post_alamat = $db->real_escape_string(filter($_POST['alamat']));
    
    if (empty($post_nim) || empty($post_nama) || empty($post_tgllahir) || empty($post_alamat)) {
        $msg_type = "error";
        $msg_content = "Semua field tidak boleh kosong.";
    } else {
        $update_data = mysqli_query($db, "UPDATE mhsw SET nim = '$post_nim', nama = '$post_nama', tgllahir = '$post_tgllahir', alamat = '$post_alamat' WHERE id = '$post_id'");
        if ($update_data == TRUE) {
            $msg_type = "success";
            $msg_content = "Data berhasil diupdate.";
        } else {
            $msg_type = "error";
            $msg_content = "System error.";
        }
    }
} else if (isset($_POST['delete'])) {
    $post_id = $db->real_escape_string($_POST['id']);
    $cek_id = mysqli_query($db, "SELECT * FROM mhsw WHERE id = '$post_id'");
    $data_id = mysqli_fetch_assoc($cek_id);
    
    if (mysqli_num_rows($cek_id) == 0) {
        $msg_type = "error";
        $msg_content = "Data tidak ditemukan.";
    } else {
        $delete_data = mysqli_query($db, "DELETE FROM mhsw WHERE id = '$post_id'");
        if ($delete_data == TRUE) {
            $msg_type = "success";
            $msg_content = "Data berhasil dihapus.";
        } else {
            $msg_type = "error";
            $msg_content = "System error.";
        }
    }
}
?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tugas Kuliah Latihan 9</h3>
            </div>
            <div class="box-body">
                <p>
                    <b>Nama</b> : Restu Fadhilah<br>
                    <b>NPM</b> : 19560009<br>
                    <h4><strong>TUGAS LATIHAN 9</strong></h4>
                </p>
            </div>
        </div>
        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Mahasiswa</h3>
            </div>
            
            <div class="box-body">

                <!-- Start Alert -->
                <?php if($msg_type == "success"){ ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    <?php echo $msg_content; ?>
                </div>
                <?php } else if($msg_type == "error"){ ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    <?php echo $msg_content; ?>
                </div>
                <?php } ?>

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th><center>Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            $cek_data = mysqli_query($db, "SELECT * FROM mhsw ORDER BY id DESC");
                            while ($data_show = mysqli_fetch_assoc($cek_data)) {
                            $no++;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data_show['nim']; ?></td>
                                <td><?php echo $data_show['nama']; ?></td>
                                <td><?php echo $data_show['tgllahir']; ?></td>
                                <td><?php echo $data_show['alamat']; ?></td>
                                <td align="center">
                                    <a href="javascript:;" onclick="modal('<?php echo $config['url']; ?>ajax/edit?id=<?php echo $data_show['id']; ?>')" class="btn btn-sm btn-info"><i class="fa fa-edit" title="Edit"></i></a>
                                    <a href="javascript:;" onclick="modal('<?php echo $config['url']; ?>ajax/delete?id=<?php echo $data_show['id']; ?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash" title="Hapus"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="box-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Mahasiswa</button>
            </div>
        </div>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="addModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Tambah Mahasiswa</h4>
                    </div>
                    <form role="form" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-control-label">NIM</label>
                                <input type="number" class="form-control" name="nim" placeholder="Masukkan NIM" inputmode="numeric" required autofocus>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Tanggal Lahir</label>
                                <input type="text" class="form-control" name="tgllahir" id="datepicker" autocomplete="off" readonly required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Alamat</label>
                                <textarea class="form-control" rows="10" name="alamat" placeholder="Alamat" required></textarea>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="add">Tambah Mahasiswa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Start Modal Crud -->
        <div class="modal fade" id="detail-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="detail-title"></h4>
                    </div>
                    <div class="modal-body" id="detail-body">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Crud -->

        <!-- Start Ajax -->
        <script type="text/javascript">
            function modal(url) {
                $.ajax({
                    type: "GET",
                    url: url,
                    beforeSend: function() {
                        $('#detail-body').html('<center><i class="fa fa-spinner fa-3x faa-spin animated"></i><br><small>Mohon menunggu...</small></center>');
                    },
                    success: function(result) {
                        $('#detail-body').html(result);
                        var e = document.getElementById('getTitle');
                        var title = e.getAttribute('title-modal');
                        $('#detail-title').text(title);
                    },
                    error: function() {
                        $('#detail-body').html('Terjadi kesalahan.');
                    }
                });
                $('#detail-modal').modal();
            }
        </script>
<?php
include('lib/footer.php');
?>