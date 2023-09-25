<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"></h1>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header justify-content-center">
					Form Ubah Data Slider
				</div>
				<div class="card-body">
					<form action="<?= base_url('slider/update');?>" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?=$slider['id']; ?>">
						<div class="form-group">
							<label for="judul">Judul</label>
							<input type="text" name="judul" class="form-control"
								value="<?=$slider['judul']; ?>" id="judul" placeholder="Masukkan Judul">
						</div>
						<div class="form-group">
							<label for="deskripsi">Deskripsi</label>
							<textarea name="deskripsi" class="form-control"
                                id="deskripsi"><?= $slider['deskripsi'] ?></textarea>
						</div>
						<div class="form-group">
							<label for="gambar">Gambar</label><br>
							<img src="<?=base_url($slider['gambar'])?>" width="100">
							<input type="file" name="gambar" class="form-control"
								id="gambar" placeholder="gambar">
						</div>
						<a href="<?= base_url('slider') ?>" class="btn btn-danger">Tutup</a>
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
