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
                                                <label for="">Pilih Type Topic :</label>
                                                <div>
                                                    <label class="c-input c-radio">
                                                        <input id="radio1" name="type" value="close" type="radio" onclick="private()">
                                                        <span class="c-indicator"></span>
                                                        Close
                                                    </label>
                                                    <label class="c-input c-radio">
                                                        <input id="radio1" name="type" value="public" checked type="radio" onclick="public()">
                                                        <span class="c-indicator"></span>
                                                        Public
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="addPrivate" class="collapse">
                                                <div id="addProvinsi" class="form-group">
                                                    <label for="provinsi">Provinsi</label>
                                                    <?php echo $this->wilayah->generateSelectProvinsi() ?>
                                                </div>
                                                <div id="addKota" class="form-group">
                                                    <label for="provinsi">Kota</label>
                                                    <?php echo $this->wilayah->generateSelectKota() ?>
                                                </div>
                                                <div id="addKecamatan" class="form-group">
                                                    <label for="provinsi">Kecamatan</label>
                                                    <?php echo $this->wilayah->generateSelectKecamatan() ?>
                                                </div>
                                                <div id="addDesa" class="form-group">
                                                    <label for="provinsi">Desa</label>
                                                    <?php echo $this->wilayah->generateSelectDesa() ?>
                                                </div>
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

    <script type="text/javascript">
        function private(){
            $('#addPrivate').collapse('show');
        }

        function public(){
            $('#addPrivate').collapse('hide');
        }
    </script>
<?php endcustom_script() ?>
<?php get_footer(); ?>