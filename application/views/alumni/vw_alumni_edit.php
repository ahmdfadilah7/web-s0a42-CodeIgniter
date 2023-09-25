<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"></h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header justify-content-center">
                    Form Ubah Data alumni
                </div>
                <div class="card-body">
                    <form action="<?= base_url('alumni/update');?>" method="POST" id="alumni">
                        <input type="hidden" name="id" value="<?=$alumni['id']; ?>">
                        <div class="form-group">
                            <label for="nama_alumni">Nama Alumni</label>
                            <input type="text" name="nama_alumni" class="form-control"
                                value="<?=$alumni['nama_alumni']; ?>" id="nama_alumni" placeholder="nama_alumni">
                        </div>
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" name="nisn" class="form-control" value="<?=$alumni['nisn']; ?>" id="nisn"
                                placeholder="nisn">
                        </div>
                        <div class="form-group">
                            <label for="nama">Jenis Kelamin</label>
                            <select type="text" name="jk" value="<?= set_value('jk'); ?>" class="form-control" id="jk">
                                <option value="">Jenis Kelamin</option>
                                <option value="Laki-Laki" <?php if($alumni['jk']=='Laki-Laki'){ echo 'selected'; } ?>>
                                    Laki-Laki</option>
                                <option value="Perempuan" <?php if($alumni['jk']=='Perempuan'){ echo 'selected'; } ?>>
                                    Perempuan</option>
                            </select>
                            <?= form_error('jk', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select name="id_jurusan" id="jurusan" class="form-control "
                                value="<?= set_value('jurusan'); ?>">
                                <option value="">Pilih Jurusan</option>
                                <?php 
									foreach ($jurusan as $j) : 
										$select = '';
										if ($j['id_jurusan'] == $alumni['id_jurusan']) {
											$select = 'selected';
										}
								?>
                                <option value="<?= $j['id_jurusan']; ?>" <?= $select ?>><?= $j['nama_jurusan']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="angkatan">Angkatan</label>
                            <input type="text" name="angkatan" class="form-control" value="<?=$alumni['angkatan']; ?>"
                                id="angkatan" placeholder="angkatan">
                        </div>
                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <input type="text" name="tahun_lulus" class="form-control"
                                value="<?=$alumni['tahun_lulus']; ?>" id="tahun_lulus" placeholder="tahun_lulus">
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
                                    <input class="custom-control-input" type="radio" value="<?= $row['status'] ?>"
                                        id="customRadio<?=$no?>" name="status" <?php if($row['status']==$alumni['status']){ echo 'checked'; } ?> onchange="showform('<?= $stts ?>')">
                                    <label for="customRadio<?=$no?>"
                                        class="custom-control-label"><?= $row['status'] ?></label>
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
										<input type="text" name="c<?= $stts.$value['urutan'] ?>" class="form-control" id="c<?= $stts.$value['urutan'] ?>" value="<?= $alumni['c'.$value['urutan']] ?>" placeholder="<?= $value['kusioner'] ?>">
									</div>
								<?php
										} elseif ($value['tag_input']=='select-gaji') {
								?>
									<div class="form-group">
										<label for="<?= $value['kusioner'] ?>"><?= $value['kusioner'] ?></label>
										<select name="c<?= $stts.$value['urutan'] ?>" class="form-control">
											<option value="">- Pilih -</option>
											<?php
												$tag_input = $value['tag_input'];
												$taginput = $this->db->query("SELECT * FROM taginput WHERE tag_input = '$tag_input'")->result();
												foreach ($taginput as $row) {
													$select = '';
													if ($row->isi == $alumni['c'.$value['urutan']]) {
														$select = 'selected';
													}
											?>
												<option value="<?= $row->isi ?>" <?= $select ?>><?= $row->isi ?></option>
											<?php
												}
											?>
										</select>
									</div>
								<?php
										} elseif ($value['tag_input']=='radio') {
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
											id="<?=$i?>" name="c<?= $stts.$value['urutan'] ?>" <?php if($row->isi==$alumni['c'.$value['urutan']]){ echo 'checked'; } ?>>
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
                            <button type="submit" name="tambah" class="btn btn-primary float-right">Ubah data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	<?php
		foreach ($status as $row) {
			$stts = str_replace('/','_', str_replace(' ', '_', $row['status']));
			if ($row['status']==$alumni['status']) {
	?>
		const <?= $stts ?> = document.getElementById("<?= $stts ?>");	
		<?= $stts ?>.style.display = "block";	 
	<?php
			}
		}
	?>

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