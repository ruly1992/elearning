<!-- start:content -->
<div class="container content content-single content-dashboard content-konsultasi">
    <section id="content">

        <!-- start:content -->
        <div class="content-konsultasi-main">
            <div class="content-konsultasi-title">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Mulai Konsultasi</h2>
                    </div>
                </div>
            </div>
            <div class="content-konsultasi-table">
                <p>Jika Anda tidak menemukan solusi masalah Anda, Anda bisa memulai konsultasi dengan memilih departemen yang dituju.</p>
                <ul class="list-divisi">
                <?php foreach ($categories as $row): ?>
                    <li>
                        <h4><a href="<?php echo base_url('/konsultasi/index.php/konsultasi/kategori').'/'.$row->id ?>"><i class="fa fa-envelope"></i><?php echo $row->name ?></a></h4>
                        <p><?php echo $row->description ?></p>
                    </li>
                <?php endforeach ?>
                </ul>
            </div>
        </div>
        <!-- end:content -->

    </section>
</div>
<!-- emd:content -->