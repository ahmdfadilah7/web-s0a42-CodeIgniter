    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            
            <?php
                foreach ($slider as $row):
            ?>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="<?php echo base_url($row['gambar'])?>" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown"><?= setting()->nama_website ?></h5>
                                <h1 class="display-3 text-white animated slideInDown"><?= $row['judul'] ?></h1>
                                <div class="fs-5 text-white mb-4 pb-2">
                                    <?= $row['deskripsi'] ?>
                                </div>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="auth" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
            ?>
            
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About -->
    <?php
        foreach ($about as $ab):
        endforeach;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= $ab['gambar'] ?>" class="w-100">
            </div>
            <div class="col-md-8">
                <h3><?= $ab['judul'] ?></h3>
                <?= $ab['deskripsi'] ?>
            </div>
        </div>
    </div>
