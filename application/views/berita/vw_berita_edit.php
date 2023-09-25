<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"></h1>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header justify-content-center">
					Form Ubah Data Berita
				</div>
				<div class="card-body">
					<form action="<?= base_url('berita/update');?>" method="POST" id="berita">
						<input type="hidden" name="id" value="<?=$berita['id_berita']; ?>">
						<div class="form-group">
							<label for="judul_berita">Nama Alumni</label>
							<input type="text" name="judul_berita" class="form-control"
								value="<?=$berita['judul_berita']; ?>" id="judul_berita" placeholder="judul_berita">
						</div>
						<div class="form-group">
							<label for="deskripsi">Deskripsi</label>
							<textarea name="deskripsi" class="form-control"
                                id="deskripsi"><?= $berita['deskripsi'] ?></textarea>
						</div>
                        <div class="form-group">
							<label for="tanggal_posting">Jurusan</label>
							<input type="date" name="tanggal_posting" class="form-control"
								value="<?=$berita['tanggal_posting']; ?>" id="tanggal_posting" placeholder="tanggal_posting">
						</div>
						<div class="form-group">
							<label for="gambar">Gambar</label><br>
							<img src="<?=base_url($berita['gambar'])?>" width="100">
							<input type="file" name="gambar" class="form-control"
								id="gambar" placeholder="gambar">
						</div>
						<a href="<?= base_url('berita') ?>" class="btn btn-danger">Tutup</a>
						<button type="submit" name="tambah" class="btn btn-primary float-right">Ubah data</button>
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
