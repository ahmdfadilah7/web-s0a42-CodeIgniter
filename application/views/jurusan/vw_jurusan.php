<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>

    <div class="card">
      <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <a href="<?= base_url() ?>jurusan/tambah" class="btn btn-info mb-2" data-toggle="modal"
                    data-target="#modal-lg"><i class="fa fa-plus"></i> Tambah Jurusan</a>
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Jurusan</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($jurusan as $us) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $us['nama_jurusan'] ?></td>
                            <td>
                                <a href="<?= base_url('jurusan/delete/') . $us['id_jurusan']; ?>"
                                    class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                                <a href="<?= base_url('jurusan/edit/') . $us['id_jurusan']; ?>"
                                    class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
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
<!-- modal CRUD -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Data Jurusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('jurusan/tambah');?>" id="jurusan">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_role">Nama Jurusan</label>
                            <input type="text" name="nama_jurusan" class="form-control" id="nama_jurusan"
                                placeholder="nama_jurusan">
                        </div>
                        <a href="<?= base_url('jurusan') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Jurusan</button>
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