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

                    <a href="<?= base_url() ?>kusioner/tambah" class="btn btn-info mb-2"
                        data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Tambah kusioner</a>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Status</td>
                                    <td>Kusioner</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kusioner as $us) : ?>
                                <tr id="<?= $us['id'] ?>">
                                    <td><?= $i; ?></td>
                                    <td><?= $us['status'] ?></td>
                                    <td><?= $us['kusioner'] ?></td>
                                    <td>
                                        <button type="submit" class="btn btn-danger btn-sm remove" title="Hapus"> 
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a href="<?= base_url('kusioner/edit/') . $us['id']; ?>"
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
                <h4 class="modal-title">Form Data kusioner</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('kusioner/tambah');?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" name="status" class="form-control"
                                id="status" placeholder="Masukkan Status">
                        </div>
                        <div class="form-group">
                            <label for="urutan">Urutan</label>
                            <input type="number" name="urutan" class="form-control"
                                id="urutan" placeholder="Masukkan Urutan">
                        </div>
                        <div class="form-group">
                            <label for="kusioner">Kusioner</label>
                            <input type="text" name="kusioner" class="form-control"
                                id="kusioner" placeholder="Masukkan Kusioner">
                        </div>
                        <div class="form-group">
                            <label for="tag_input">Tag Input</label>
                            <select name="tag_input" class="form-control">
                                <option value=" ">- Pilih -</option>
                                <option value="input">input</option>
                                <?php
                                    foreach ($taginput as $row) {
                                ?>
                                    <option value="<?= $row['tag_input'] ?>"><?= $row['tag_input'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <a href="<?= base_url('kusioner') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="tambah"
                            class="btn btn-primary float-right">Tambah kusioner</button>
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
                url: '<?=base_url('kusioner/delete/')?>'+id,
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