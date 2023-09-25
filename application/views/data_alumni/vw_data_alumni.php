<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="card">
        <div class="card-body">
            <div class="row">        
                <div class="col-md-12">
                    <?php
                        if($this->session->flashdata('berhasil')) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('berhasil') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        }
                    ?>
                    <form action="<?= base_url('data_alumni') ?>" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Jurusan</label>
                                    <select name="jurusan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <?php
                                            foreach ($jurusan as $row) {
                                        ?>
                                            <option value="<?= $row['id_jurusan'] ?>"><?= $row['nama_jurusan'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tahun Lulus</label>
                                    <input type="number" name="tahun_lulus" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2 mt-4">
                                <div class="d-flex">
                                    <input type="submit" name="submit" class="btn btn-primary mt-2 mr-2" value="Filter">
                                    <input type="submit" name="submit" class="btn btn-success mt-2 mr-2" value="Export">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>NISN</td>
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
                                <tr id=<?= $us['id'] ?>>
                                    <td><?= $i; ?>.</td>
            
                                    <td><?= $us['nama_alumni']; ?></td>
                                    <td><?= $us['nisn']; ?></td>
                                    <td><?= $us['jurusan']; ?></td>
                                    <td><?= $us['angkatan']; ?></td>
                                    <td><?= $us['tahun_lulus']; ?></td>
                                    <td><?= str_replace('_', ' ',$us['status']); ?></td>
                                    <td>
                                        <a href="javascript:;"
                                            data-id="<?= $us['id'] ?>"
                                            class="btn btn-info btn-sm view" title="Detail"><i
                                                class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm remove" title="Hapus"> 
                                            <i class="fa fa-trash"></i>
                                        </button>
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
</div>

<div class="modal fade" id="modal-view" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="judul"></h4>
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
                                <td id="nisn"></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>:</td>
                                <td></td>
                                <td id="nama_alumni"></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>:</td>
                                <td></td>
                                <td id="jk"></td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>:</td>
                                <td></td>
                                <td id="jurusan"></td>
                            </tr>
                            <tr>
                                <th>Angkatan</th>
                                <td>:</td>
                                <td></td>
                                <td id="angkatan"></td>
                            </tr>
                            <tr>
                                <th>Tahun Lulus</th>
                                <td>:</td>
                                <td></td>
                                <td id="tahun"></td>
                            </tr>                            
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td></td>
                                <td id="status"></td>
                            </tr>
                            <tr id="kusioner_view_1" style="display: none;">
                                <th id="kusioner_title_1"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_1"></td>
                            </tr>
                            <tr id="kusioner_view_2" style="display: none;">
                                <th id="kusioner_title_2"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_2"></td>
                            </tr>
                            <tr id="kusioner_view_3" style="display: none;">
                                <th id="kusioner_title_3"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_3"></td>
                            </tr>
                            <tr id="kusioner_view_4" style="display: none;">
                                <th id="kusioner_title_4"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_4"></td>
                            </tr>
                            <tr id="kusioner_view_5" style="display: none;">
                                <th id="kusioner_title_5"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_5"></td>
                            </tr>
                            <tr id="kusioner_view_6" style="display: none;">
                                <th id="kusioner_title_6"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_6"></td>
                            </tr>
                            <tr id="kusioner_view_7" style="display: none;">
                                <th id="kusioner_title_7"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_7"></td>
                            </tr>
                            <tr id="kusioner_view_8" style="display: none;">
                                <th id="kusioner_title_8"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_8"></td>
                            </tr>
                            <tr id="kusioner_view_9" style="display: none;">
                                <th id="kusioner_title_9"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_9"></td>
                            </tr>
                            <tr id="kusioner_view_10" style="display: none;">
                                <th id="kusioner_title_10"></th>
                                <td>:</td>
                                <td></td>
                                <td id="kusioner_10"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
<!-- /.modal-content -->
</div>

<script type="text/javascript">
    $('.view').on('click', function (event) {
        var id = $(this).attr('data-id');
		 $.ajax({						
            url : "<?php echo site_url('data_alumni/view/')?>"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {					
                $('#nisn').html(data.nisn);								
                $('#nama_alumni').html(data.nama);								
                $('#jk').html(data.jk);								
                $('#jurusan').html(data.jurusan);								
                $('#angkatan').html(data.angkatan);								
                $('#tahun').html(data.tahun);								
                $('#status').html(data.status);
                if (data.kusioner1 != null) {
                    document.getElementById("kusioner_view_1").style.display = "table-row";
                    $('#kusioner_title_1').html(data.kusioner1);
                    $('#kusioner_1').html(data.c1);
                }
                if (data.kusioner2 != null) {
                    document.getElementById("kusioner_view_2").style.display = "table-row";
                    $('#kusioner_title_2').html(data.kusioner2);
                    $('#kusioner_2').html(data.c2);
                }
                if (data.kusioner3 != null) {
                    document.getElementById("kusioner_view_3").style.display = "table-row";
                    $('#kusioner_title_3').html(data.kusioner3);
                    $('#kusioner_3').html(data.c3);
                }
                if (data.kusioner4 != null) {
                    document.getElementById("kusioner_view_4").style.display = "table-row";
                    $('#kusioner_title_4').html(data.kusioner4);
                    $('#kusioner_4').html(data.c4);
                }
                if (data.kusioner5 != null) {
                    document.getElementById("kusioner_view_5").style.display = "table-row";
                    $('#kusioner_title_5').html(data.kusioner5);
                    $('#kusioner_5').html(data.c5);
                }
                if (data.kusioner6 != null) {
                    document.getElementById("kusioner_view_6").style.display = "table-row";
                    $('#kusioner_title_6').html(data.kusioner6);
                    $('#kusioner_6').html(data.c6);
                }
                if (data.kusioner7 != null) {
                    document.getElementById("kusioner_view_7").style.display = "table-row";
                    $('#kusioner_title_7').html(data.kusioner7);
                    $('#kusioner_7').html(data.c7);
                }
                if (data.kusioner8 != null) {
                    document.getElementById("kusioner_view_8").style.display = "table-row";
                    $('#kusioner_title_8').html(data.kusioner8);
                    $('#kusioner_8').html(data.c8);
                }
                if (data.kusioner9 != null) {
                    document.getElementById("kusioner_view_9").style.display = "table-row";
                    $('#kusioner_title_9').html(data.kusioner9);
                    $('#kusioner_9').html(data.c9);
                }
                if (data.kusioner10 != null) {
                    document.getElementById("kusioner_view_10").style.display = "table-row";
                    $('#kusioner_title_10').html(data.kusioner10);
                    $('#kusioner_10').html(data.c10);
                }
                $('#modal-view').modal('show'); 							
            }
        });	
    });
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");
    
        swal({
            title: "Apakah Kamu yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
            $.ajax({
                url: '<?=base_url('data_alumni/delete/')?>'+id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    $("#"+id).remove();
                    swal("Berhasil", "Data Berhasil dihapus", "success");
                }
            });
            } else {
            swal("Dibatalkan", "Batal menghapus data ini", "error");
            }
        });
     
    });
    
</script>