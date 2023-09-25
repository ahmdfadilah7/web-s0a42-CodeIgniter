<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"></h1>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header justify-content-center">
					Form Ubah Data Kusioner
				</div>
				<div class="card-body">
					<form action="<?= base_url('kusioner/update');?>" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?=$kusioner['id']; ?>">
						<div class="form-group">
							<label for="status">Status</label>
							<input type="text" name="status" class="form-control"
								value="<?=$kusioner['status']; ?>" id="status" placeholder="Masukkan Status">
						</div>
						<div class="form-group">
							<label for="urutan">Urutan</label>
							<input type="text" name="urutan" class="form-control"
								value="<?=$kusioner['urutan']; ?>" id="urutan" placeholder="Masukkan Urutan">
						</div>
						<div class="form-group">
							<label for="kusioner">Kusioner</label>
							<input type="text" name="kusioner" class="form-control"
								value="<?=$kusioner['kusioner']; ?>" id="kusioner" placeholder="Masukkan Kusioner">
						</div>
						<div class="form-group">
                            <label for="tag_input">Tag Input</label>
                            <select name="tag_input" class="form-control">
                                <option value=" ">- Pilih -</option>
								<option value="input" <?php if($kusioner['tag_input']=='input'){ echo 'selected';} ?>>input</option>
                                <?php
                                    foreach ($taginput as $row) {
										$select = '';
										if ($row['tag_input'] == $kusioner['tag_input']) {
											$select = 'selected';
										}
                                ?>
                                    <option value="<?= $row['tag_input'] ?>" <?= $select ?>><?= $row['tag_input'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
						<a href="<?= base_url('kusioner') ?>" class="btn btn-danger">Tutup</a>
						<button type="submit" name="tambah" class="btn btn-primary float-right">Simpan data</button>
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
</div>
