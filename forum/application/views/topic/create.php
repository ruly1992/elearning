<?php get_header('private', array('active' => 'forum')); ?>

        <!-- start:content -->
        <div class="container content content-single content-dashboard content-forum">
            <section id="content">

                <!-- start:content -->
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <!-- start:content main -->
                        <div class="content-main">
                            <ol class="breadcrumb">
                                <li><?php echo anchor('thread/', 'Home') ?></li>
                                <li><?php echo anchor('topic/', 'Topics'); ?></li>
                                <li class="active">Create New Topic</li>
                            </ol>
                            <div class="forum-main">
                                <div class="card">
                                    <div class="card-block">
                                       
                                        <?php echo form_open('topic/save'); ?>
                                            <div class="form-group">
                                                <label for="">Kategori :</label>
                                                <select class="c-select form-control" name="kategori">
                                                    <?php 
                                                        foreach($categories as $cat){
                                                            echo '<option value="'.$cat->id.'">'.$cat->category_name.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Topic</label>
                                                <input type="text" required name="topic" class="form-control" placeholder="type your title">
                                            </div>
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi</label>
                                                <?php echo $this->wilayah->generateSelectProvinsi() ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="kota">City/Kota</label>
                                                <?php echo $this->wilayah->generateSelectKota() ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <?php echo $this->wilayah->generateSelectKecamatan() ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="desa">Desa</label>
                                                <?php echo $this->wilayah->generateSelectDesa() ?>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">CREATE NEW TOPIC</button>
                                                <?php echo anchor('topic/', 'Cancel', 'class="btn btn-secondary"'); ?>
                                            </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:content main -->
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="sidebar-forum">
                            <?php $this->load->view('template/sidebar'); ?>
                        </div>
                    </div>
                </div>
                <!-- end:content -->

            </section>
        </div>
        <!-- emd:content -->

<?php custom_script(); ?>
    <script src="<?php echo asset('node_modules/jquery-chained/jquery.chained.remote.js'); ?>"></script>
    <?php echo $this->wilayah->script(site_url('topic/wilayah')); ?>
<?php endcustom_script() ?>
<?php get_footer(); ?>