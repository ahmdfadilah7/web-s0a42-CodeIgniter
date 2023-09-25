<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
        
                <?php
                    if ($cek_alumni == 0) {
                ?>
                    <a href="<?= base_url() ?>alumni/tambah" class="btn btn-info mb-2">Tambah
                        Alumni</a>
                <?php
                    }
                ?>
                <div class="col-md-12">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>NISN</td>
                                <td>Jenis Kelamin</td>
                                <td>Jurusan</td>
                                <td>Angkatan</td>
                                <td>Tahun Lulus</td>
                                <td>Status</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($alumni as $us) : ?>
                            <tr>
                                <td><?= $i; ?>.</td>
        
                                <td><?= $us['nama_alumni']; ?></td>
                                <td><?= $us['nisn']; ?></td>
                                <td><?= $us['jk']; ?></td>
                                <td><?= $us['jurusan']; ?></td>
                                <td><?= $us['angkatan']; ?></td>
                                <td><?= $us['tahun_lulus']; ?></td>
                                <td><?= str_replace('_', ' ', $us['status']); ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#modal-lg"
                                        class="btn btn-info btn-sm" title="Detail"><i class="fa fa-eye"></i></a>
                                    <a href="<?= base_url('alumni/edit/') . $us['id']; ?>"
                                        class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url('alumni/delete/') . $us['id']; ?>"
                                        class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
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

<div class="modal fade" id="modal-lg" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <th>NISN</th>
                                <td>:</td>
                                <td></td>
                                <td><?= $us['nisn'] ?></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>:</td>
                                <td></td>
                                <td><?= $us['nama_alumni'] ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>:</td>
                                <td></td>
                                <td><?= $us['jk'] ?></td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>:</td>
                                <td></td>
                                <td><?= $us['jurusan'] ?></td>
                            </tr>
                            <tr>
                                <th>Angkatan</th>
                                <td>:</td>
                                <td></td>
                                <td><?= $us['angkatan'] ?></td>
                            </tr>
                            <tr>
                                <th>Tahun Lulus</th>
                                <td>:</td>
                                <td></td>
                                <td><?= $us['tahun_lulus'] ?></td>
                            </tr>                            
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td></td>
                                <td><?= str_replace('_', ' ', $us['status']) ?></td>
                            </tr>
                            <?php
                                $status = str_replace('_', ' ', $us['status']);
                                $kusioner = $this->db->query("SELECT * FROM kusioner WHERE status = '$status'")->result_array();
                                foreach ($kusioner as $row) {
                            ?>
                                <tr>
                                    <th><?= $row['kusioner'] ?></th>
                                    <td>:</td>
                                    <td></td>
                                    <td><?= $us['c'.$row['urutan']] ?></td>
                                </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->