<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"></h1>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header justify-content-center">
					Form Ubah Data Jurusan
				</div>
				<div class="card-body">
					<form action="<?= base_url('jurusan/update');?>" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?=$jurusan['id_jurusan']; ?>">
						<div class="form-group">
							<label for="nama_jurusan">Nama Jurusan</label>
							<input type="text" name="nama_jurusan" class="form-control"
								value="<?=$jurusan['nama_jurusan']; ?>" id="nama_jurusan" placeholder="Masukkan Nama Jurusan">
						</div>
						<a href="<?= base_url('jurusan') ?>" class="btn btn-danger">Tutup</a>
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
