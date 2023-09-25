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

                        if ($cek_about == 0) {
                    ?>
                    <a href="<?= base_url() ?>about/tambah" class="btn btn-info mb-2"
                        data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Tambah about</a>
                    <?php
                        }
                    ?>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Judul</td>
                                    <td>Deskripsi</td>
                                    <td>Gambar</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($about as $us) : ?>
                                <tr id="<?= $us['id'] ?>">
                                    <td><?= $i; ?></td>
                                    <td><?= $us['judul'] ?></td>
                                    <td><?= $us['deskripsi'] ?></td>
                                    <td><img src="<?= base_url($us['gambar']) ?>" width="50"></td>
                                    <td>
                                        <button type="submit" class="btn btn-danger btn-sm remove" title="Hapus"> 
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a href="<?= base_url('about/edit/') . $us['id']; ?>"
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
                <h4 class="modal-title">Form Data about</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('about/tambah');?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" class="form-control"
                                id="judul" placeholder="Masukkan Judul">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"
                                id="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="gambar"
                                placeholder="gambar">
                        </div>

                        <a href="<?= base_url('about') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="tambah"
                            class="btn btn-primary float-right">Tambah about</button>
                </form>

                <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace('deskripsi');
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
                url: '<?=base_url('about/delete/')?>'+id,
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