                  
                  <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
                    <div class="row">
                        <div class="col-md-6"><a href="<?= base_url() ?>role/tambah" class="btn btn-info mb-2" data-toggle="modal" data-target="#modal-lg" >Tambah Berita</a></div>
                        <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Role</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($role as $us) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $us['nama_role'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('role/delete/') . $us['id_role']; ?>" class="badge badge-danger">Hapus</a>
                                                    <a href="<?= base_url('role/edit/') . $us['id_role']; ?>" class="badge badge-warning">Edit</a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                        </div>        
                    </div>
                </div>
                <!-- modal CRUD -->
                <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Data Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="<?= base_url('role/tambah');?>" id="role">
                <div class="card-body">
                <div class="form-group">
                        <label for="nama_role">Nama Role</label>
                        <input type="text" name="nama_role" class="form-control" id="nama_role" placeholder="nama_role">
                        </div>
                        <a href="<?= base_url('role') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Role</button>
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