<!-- start:content -->
<div class="container content content-single content-dashboard content-konsultasi">
    <section id="content">

        <!-- start:content -->
        <div class="content-konsultasi-main">
            <div class="content-konsultasi-title">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Mulai Konsultasi</h3>
                    </div>
                </div>
            </div>
            <div class="content-konsultasi-table">
                <p>Anda bisa memulai konsultasi dengan memilih kategori yang dituju.</p>
                <ul class="list-divisi">
                <?php foreach ($categories as $row): ?>
                    <div class="col-md-4 col-lg-4">
                        <li class="list-content">
                            <div class="list-content-icon">
                                <p><i class="fa fa-envelope"></i></p>
                            </div>
                            <div class="list-content-description">
                                <p><?php echo $row->description ?></p>
                            </div>
                            <div class="list-content-title">
                               <h4><a href="<?php echo site_url('/dashboard/kategori').'/'.$row->id_kategori ?>"><?php echo $row->name ?></a></h4> 
                            </div>
                        </li>
                    </div>
                <?php endforeach ?>
                </ul>
            </div>
        </div>
        <!-- end:content -->

    </section>
</div>
<!-- emd:content -->