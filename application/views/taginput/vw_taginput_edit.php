<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"></h1>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header justify-content-center">
					Form Ubah Data Tag Input
				</div>
				<div class="card-body">
					<form action="<?= base_url('taginput/update');?>" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?=$taginput['id']; ?>">
						<div class="form-group">
							<label for="tag_input">Tag Input</label>
							<input type="text" name="tag_input" class="form-control"
								value="<?=$taginput['tag_input']; ?>" id="tag_input" placeholder="Masukkan Tag Input">
						</div>
						<div class="form-group">
							<label for="isi">Isi</label>
							<input type="text" name="isi" class="form-control"
								value="<?=$taginput['isi']; ?>" id="isi" placeholder="Masukkan Isi">
						</div>
						<a href="<?= base_url('taginput') ?>" class="btn btn-danger">Tutup</a>
						<button type="submit" name="tambah" class="btn btn-primary float-right">Simpan data</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
