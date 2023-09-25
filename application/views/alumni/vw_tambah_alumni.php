<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="row justify-content-center">
        Form Isi Data Alumni
    </div>
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_alumni">Nama Alumni</label>
                <input type="text" name="nama_alumni" value="<?= set_value('nama_alumni'); ?>" class="form-control" id="nama_alumni" placeholder="Nama Alumni">
                <?= form_error('nama_alumni', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="nisn">NISN</label>
                <input type="text" name="nisn" value="<?= set_value('nisn'); ?>" class="form-control" id="nisn" placeholder="nisn">
                <?= form_error('nisn', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="nama">Jenis Kelamin</label>
                <select type="text" name="jk" value="<?= set_value('jk'); ?>" class="form-control" id="jk">
                    <option value="">Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <?= form_error('jk', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select name="id_jurusan" id="jurusan" class="form-control " value="<?= set_value('jurusan'); ?>">
                    <option value="">Pilih Jurusan</option>
                    <?php foreach ($jurusan as $j) : ?>
                        <option value="<?= $j['id_jurusan']; ?>"><?= $j['nama_jurusan']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <input type="text" name="angkatan" value="<?= set_value('angkatan'); ?>" class="form-control" id="angkatan" placeholder="Angkatan">
                <?= form_error('angkatan', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="tahun_lulus">Tahun Lulus</label>
                <input type="text" name="tahun_lulus" value="<?= set_value('tahun_lulus'); ?>" class="form-control" id="tahun_lulus" placeholder="Tahun Lulus">
                <?= form_error('tahun_lulus', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="form-group">
                    <?php
                        $no = 1;
                        foreach ($status as $row) :
                            $stts = str_replace('/','_', str_replace(' ', '_', $row['status']));
                    ?>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="<?= $row['status'] ?>" id="customRadio<?=$no?>" name="status" onchange="showform('<?= $stts ?>')">
                            <label for="customRadio<?=$no?>" class="custom-control-label"><?= $row['status'] ?></label>
                        </div>
                    <?php
                        $no++;
                        endforeach
                    ?>
                </div>

                <?php
                    foreach ($status as $row) :
                        $stts = str_replace('/','_', str_replace(' ', '_', $row['status']));
                ?>
                <div id="<?= $stts ?>" style="display: none;">
                    <?php
                        $stts2 = $row['status'];
                        $kusioner = $this->db->query("SELECT * FROM kusioner WHERE status = '$stts2'");
                        foreach ($kusioner->result_array() as $value) {
                            if ($value['tag_input'] == 'input') {
                    ?>
                        <div class="form-group">
                            <label for="<?= $value['kusioner'] ?>"><?= $value['kusioner'] ?></label>
                            <input type="text" name="c<?= $stts.$value['urutan'] ?>" class="form-control" id="c<?= $stts.$value['urutan'] ?>" placeholder="<?= $value['kusioner'] ?>">
                        </div>
                    <?php
                            } elseif ($value['tag_input'] == 'select-gaji') {
                    ?>
                        <div class="form-group">
                            <label for="<?= $value['kusioner'] ?>"><?= $value['kusioner'] ?></label>
                            <select name="c<?= $stts.$value['urutan'] ?>" class="form-control">
                                <option value="">- Pilih -</option>
                                <?php
                                    $tag_input = $value['tag_input'];
                                    $taginput = $this->db->query("SELECT * FROM taginput WHERE tag_input = '$tag_input'")->result();
                                    foreach ($taginput as $row) {
                                ?>
                                    <option value="<?= $row->isi ?>"><?= $row->isi ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    <?php
                            } elseif ($value['tag_input'] == 'radio') {
                    ?>
                        <label for="<?= $value['kusioner'] ?>"><?= $value['kusioner'] ?></label>
                    <?php
                            $tag_input = $value['tag_input'];
                            $taginput = $this->db->query("SELECT * FROM taginput WHERE tag_input = '$tag_input'")->result();
                            $i=1;
                            foreach ($taginput as $row) {
                    ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" value="<?= $row->isi ?>"
                                    id="<?=$i?>" name="c<?= $stts.$value['urutan'] ?>">
                                <label for="<?=$i?>"
                                    class="custom-control-label"><?= $row->isi ?></label>
                            </div>
                    <?php
                                $i++;
                                }
                            }
                        }
                    ?>
                </div>
                <?php
                    endforeach;
                ?>

                <a href="<?= base_url('alumni') ?>" class="btn btn-danger">Tutup</a>
                <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Siswa</button>
                <thead></thead>
        </form>
    </div>
</div>


<script>
    function showform(selectedFormId) {
        <?php
            foreach ($status as $row) {
                $stts = str_replace('/','_', str_replace(' ', '_', $row['status']));
        ?>
            const <?= $stts ?> = document.getElementById("<?= $stts ?>");

            if (selectedFormId == "<?= $stts ?>") {
                <?= $stts ?>.style.display = "block";
            } else {
                <?= $stts ?>.style.display = "none";
            }
        <?php
            }    
        ?>
                
    }
</script>