<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if($this->session->flashdata('berhasil')) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('berhasil') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        } elseif($this->session->flashdata('gagal')) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        }

                        if ($cek_setting == 0) {
                    ?>
                    <a href="<?= base_url() ?>setting/tambah" class="btn btn-info mb-2"
                        data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Tambah setting</a>
                    <?php
                        }
                    ?>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Website</td>
                                    <td>Email</td>
                                    <td>No Telp</td>
                                    <td>Alamat</td>
                                    <td>Logo</td>
                                    <td>Favicon</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($setting as $us) : ?>
                                <tr id="<?= $us['id'] ?>">
                                    <td><?= $i; ?></td>
                                    <td><?= $us['nama_website'] ?></td>
                                    <td><?= $us['email'] ?></td>
                                    <td><?= $us['no_telp'] ?></td>
                                    <td><?= $us['alamat'] ?></td>
                                    <td><img src="<?= base_url($us['logo']) ?>" width="50"></td>
                                    <td><img src="<?= base_url($us['favicon']) ?>" width="50"></td>
                                    <td>
                                        <button type="submit" class="btn btn-danger btn-sm remove" title="Hapus"> 
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a href="<?= base_url('setting/edit/') . $us['id']; ?>"
                                            class="btn btn-warning btn-sm" title="Edit"><i
                                                class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal CRUD -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Data setting</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('setting/tambah');?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_website">Nama Website</label>
                            <input type="text" name="nama_website" class="form-control"
                                id="nama_website" placeholder="Masukkan Nama Website">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control"
                                id="email" placeholder="Masukkan Email">
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No Telepon</label>
                            <input type="number" name="no_telp" class="form-control"
                                id="no_telp" placeholder="Masukkan No Telp">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control"
                                id="alamat"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" class="form-control" id="logo"
                                placeholder="logo">
                        </div>
                        <div class="form-group">
                            <label for="favicon">Favicon</label>
                            <input type="file" name="favicon" class="form-control" id="favicon"
                                placeholder="favicon">
                        </div>

                        <a href="<?= base_url('setting') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="tambah"
                            class="btn btn-primary float-right">Tambah setting</button>
                </form>

                <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace('alamat');
                </script>
            </div>

        </div>
    </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- End of Main Content -->
<script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");
    
        swal({
            title: "Apakah Kamu yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
            $.ajax({
                url: '<?=base_url('setting/delete/')?>'+id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    $("#"+id).remove();
                    swal("Berhasil", "Data Berhasil dihapus", "success");
                }
            });
            } else {
            swal("Dibatalkan", "Batal menghapus data ini", "error");
            }
        });
     
    });
    
</script>