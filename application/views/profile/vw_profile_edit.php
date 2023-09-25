<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"></h1>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header justify-content-center">
					Form Ubah Data Profile
				</div>
				<div class="card-body">
					<form action="<?= base_url('profile/update');?>" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?=$profile['id']; ?>">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama" class="form-control"
								value="<?=$profile['nama']; ?>" id="nama" placeholder="Masukkan Nama">
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" class="form-control"
								value="<?=$profile['username']; ?>" id="username" placeholder="Masukkan username">
						</div>
                        <div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" class="form-control">
                            <i class="text-danger">*Isi jika ingin mengganti password.</i>
						</div>
						<div class="form-group">
							<label for="foto">Foto</label><br>
							<img src="<?=base_url($profile['foto'])?>" width="100">
							<input type="file" name="foto" class="form-control">
						</div>
						<a href="<?= base_url('profile') ?>" class="btn btn-danger">Tutup</a>
						<button type="submit" name="tambah" class="btn btn-primary float-right">Ubah data</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
