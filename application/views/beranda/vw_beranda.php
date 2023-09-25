<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Alumni</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->db->query("SELECT * FROM user WHERE role = 'alumni'")->num_rows(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Mengisi Data Diri</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->db->query("SELECT * FROM alumni")->num_rows(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Berita Bulan ini
                            </div>
                            <?php
                                $month = date('m');
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->db->query("SELECT * FROM berita WHERE MONTH(tanggal_posting) = '$month'")->num_rows(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tahun Lulus</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jurusan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Angkatan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Map</h6>
                </div>
                <div class="card-body">
                <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
<!-- End of Main Content -->

<script src="<?php echo base_url('assets/')?>vendor/chart.js/Chart.min.js"></script>
<script>
var map = L.map('map').setView([-6.200000, 106.816666], 4);

var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

// var marker = L.marker([51.5, -0.09]).addTo(map)
//     .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

<?php
    $no=1;
    foreach ($provinsi as $row) {
        $prov = str_replace('Provinsi ', '', $row->nama_provinsi);
        $lat = $row->lat;
        $long = $row->long;
?>
var circle<?=$no?> = L.circle([<?= $lat ?>, <?= $long ?>], {
    color: 'blue',
    fillColor: 'blue',
    fillOpacity: 0.5,
    radius: 100000
}).addTo(map).bindPopup('<?= $prov ?> <br> <?php 
        $status = $this->db->query("SELECT * FROM kusioner GROUP BY status")->result();
        foreach ($status as $st) { 
            $stts = str_replace(' ', '_', $st->status);
            $nilai = $this->db->query("SELECT MAX(urutan) as urt FROM kusioner WHERE status = '$st->status'")->row();
            $jumlah = $this->db->query("SELECT * FROM alumni WHERE status = '$st->status' AND c$nilai->urt = '$prov'")->num_rows();
            echo $st->status.' : '.$jumlah.'<br>';
        }
        ?>');

<?php
    $no++;
    }
?>

// var polygon = L.polygon([
//     [51.509, -0.08],
//     [51.503, -0.06],
//     [51.51, -0.047]
// ]).addTo(map).bindPopup('I am a polygon.');


// function onMapClick(e) {
//     popup
//         .setLatLng(e.latlng)
//         .setContent('You clicked the map at ' + e.latlng.toString())
//         .openOn(map);
// }

// map.on('click', onMapClick);


// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito',
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
            <?php
                foreach ($jurusan as $jr) {
            ?> "<?= $jr['nama_jurusan'] ?>",
            <?php
                }    
            ?>
        ],
        datasets: [{
            data: [
                <?php
                    foreach ($jurusan as $jr) {
                    $id_jurusan = $jr['id_jurusan'];
                    $totaljurusan = $this->db->query("SELECT * FROM alumni WHERE id_jurusan = '$id_jurusan'")->num_rows();    
                ?>
                <?= $totaljurusan ?>,
                <?php
                    }
                ?>
            ],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});

// Pie Chart Example
var ctx2 = document.getElementById("myPieChart2");
var myPieChart2 = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: [
            <?php
                $status = $this->db->query("SELECT * FROM kusioner GROUP BY status")->result_array();
                foreach ($status as $st) {
            ?> "<?= $st['status'] ?>",
            <?php
                }    
            ?>
        ],
        datasets: [{
            data: [
                <?php
                    foreach ($status as $st) {
                    $status = $st['status'];
                    $totalstatus = $this->db->query("SELECT * FROM alumni WHERE status = '$status'")->num_rows();    
                ?>
                <?= $totalstatus ?>,
                <?php
                    }
                ?>
            ],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
                <?php
                    $tahun_lulus = $this->db->query("SELECT * FROM alumni GROUP BY tahun_lulus")->result_array();
                    foreach ($tahun_lulus as $row) {
                ?> 
                "<?= $row['tahun_lulus'] ?>",
                <?php
                    }
                ?>
        ],
        datasets: [{
            label: "Total",
            backgroundColor: "#4e73df",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: [
                    <?php
                        foreach ($tahun_lulus as $row) {   
                            $tahun = $row['tahun_lulus'];                  
                    ?>
                <?= $this->db->query("SELECT * FROM alumni WHERE tahun_lulus = '$tahun'")->num_rows() ?>,
                <?php
                        }    
                    ?>
            ],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'month'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 6
                },
                maxBarThickness: 25,
            }],
            yAxes: [{
                <?php
                    $nimax = 0;
                    foreach ($tahun_lulus as $row) {   
                        $tahun = $row['tahun_lulus'];
                        if ($this->db->query("SELECT * FROM alumni WHERE tahun_lulus = '$tahun'")->num_rows() > $nimax) {
                            $nimax = $this->db->query("SELECT * FROM alumni WHERE tahun_lulus = '$tahun'")->num_rows();
                        }
                    }    
                ?>
                ticks: {
                    min: 0,
                    max: <?= $nimax ?>,
                    maxTicksLimit: 5,
                    padding: 10,
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        legend: {
            display: false
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + tooltipItem.yLabel;
                }
            }
        },
    }
});

var ctx2 = document.getElementById("myBarChart2");
var myBarChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: [
                <?php
                    $angkatan = $this->db->query("SELECT * FROM alumni GROUP BY angkatan")->result_array();
                    foreach ($angkatan as $row) {
                ?> 
                "<?= $row['angkatan'] ?>",
                <?php
                    }
                ?>
        ],
        datasets: [{
            label: "Total",
            backgroundColor: "#4e73df",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: [
                    <?php
                        foreach ($angkatan as $row) {   
                            $angkatan_row = $row['angkatan'];                  
                    ?>
                <?= $this->db->query("SELECT * FROM alumni WHERE angkatan = '$angkatan_row'")->num_rows() ?>,
                <?php
                        }    
                    ?>
            ],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'month'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 6
                },
                maxBarThickness: 25,
            }],
            yAxes: [{
                <?php
                    $nimaxangkatan = 0;
                    foreach ($angkatan as $row) {   
                        $angkatan_row = $row['angkatan'];
                        if ($this->db->query("SELECT * FROM alumni WHERE angkatan = '$angkatan_row'")->num_rows() > $nimaxangkatan) {
                            $nimaxangkatan = $this->db->query("SELECT * FROM alumni WHERE angkatan = '$angkatan_row'")->num_rows();
                        }
                    }    
                ?>
                ticks: {
                    min: 0,
                    max: <?= $nimaxangkatan ?>,
                    maxTicksLimit: 5,
                    padding: 10,
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        legend: {
            display: false
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + tooltipItem.yLabel;
                }
            }
        },
    }
});
</script>