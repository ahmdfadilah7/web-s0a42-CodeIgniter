<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"></h1>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header justify-content-center">
					Form Ubah Data Setting
				</div>
				<div class="card-body">
					<form action="<?= base_url('setting/update');?>" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?=$setting['id']; ?>">
						<div class="form-group">
							<label for="nama_website">Nama Website</label>
							<input type="text" name="nama_website" class="form-control"
								value="<?=$setting['nama_website']; ?>" id="nama_website" placeholder="Masukkan Nama Website">
						</div>
                        <div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" class="form-control"
								value="<?=$setting['email']; ?>" id="email" placeholder="Masukkan Email">
						</div>
                        <div class="form-group">
							<label for="no_telp">No Telp</label>
							<input type="number" name="no_telp" class="form-control"
								value="<?=$setting['no_telp']; ?>" id="no_telp" placeholder="Masukkan No Telp">
						</div>
                        <div class="form-group">
							<label for="nama_website">Nama Website</label>
							<input type="text" name="nama_website" class="form-control"
								value="<?=$setting['nama_website']; ?>" id="nama_website" placeholder="Masukkan Nama Website">
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<textarea name="alamat" class="form-control"
                                id="alamat"><?= $setting['alamat'] ?></textarea>
						</div>
						<div class="form-group">
							<label for="logo">Logo</label><br>
							<img src="<?=base_url($setting['logo'])?>" width="100">
							<input type="file" name="logo" class="form-control"
								id="logo" placeholder="logo">
						</div>
                        <div class="form-group">
							<label for="favicon">Favicon</label><br>
							<img src="<?=base_url($setting['favicon'])?>" width="100">
							<input type="file" name="favicon" class="form-control"
								id="favicon" placeholder="favicon">
						</div>
						<a href="<?= base_url('setting') ?>" class="btn btn-danger">Tutup</a>
						<button type="submit" name="tambah" class="btn btn-primary float-right">Ubah data</button>
					</form>
					<script>
					// Replace the <textarea id="editor1"> with a CKEditor 4
					// instance, using default configuration.
					CKEDITOR.replace('alamat');
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
