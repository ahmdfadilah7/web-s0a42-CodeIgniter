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
                    ?>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="<?= base_url() ?>user/tambah" class="btn btn-info mb-2" data-toggle="modal"
                                data-target="#modal-lg"><i class="fa fa-plus"></i> Tambah User</a>
                        </div>
                        
                        <form action="<?= base_url('user/import_excel'); ?>" method="post" class="d-flex" enctype="multipart/form-data">
                            <div class="form-group mr-3">
                                <label>Pilih File Excel</label>
                                <input type="file" name="fileExcel" class="form-control">
                            </div>
                            <div>
                                <button class='btn btn-success mt-4' type="submit">
                                    <i class="fa fa-file-import"></i>
                                    Import		
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Foto</th>
                                    <th>Role</th>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($user1 as $us) : ?>
                                <tr id="<?= $us['id'] ?>">
                                    <td> <?= $i; ?>.</td>
                                    <td> <?= $us['nama']; ?></td>
                                    <td> <?= $us['username']; ?></td>
                                    <td> <img src="<?= base_url($us['foto']) ?>" width="50"></td>
                                    <td> <?= $us['role']; ?></td>
                                    <td>
                                        <button type="submit" class="btn btn-danger btn-sm remove" title="Hapus"> 
                                            <i class="fa fa-trash"></i>
                                        </button>
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
                <h4 class="modal-title">Form Data User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('user/tambah');?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="Masukkan Username">
                        </div>
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role">
                                <option value=" ">- Pilih -</option>
                                <option value="admin">Admin</option>
                                <option value="alumni">Alumni</option>
                            </select>
                        </div>

                        <a href="<?= base_url('user') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah User</button>
                </form>
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
                url: '<?=base_url('user/delete/')?>'+id,
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