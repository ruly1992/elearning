<?php get_header('private'); ?>

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
                                <li class="active">Edit Topic</li>
                            </ol>
                            <div class="forum-main">
                                <div class="card">
                                    <div class="card-block">
                                       
                                        <?php echo form_open('topic/update/'.$idTopic); ?>
                                            <div class="form-group">
                                                <label for="">Kategori :</label>
                                                <select class="c-select form-control" name="kategori">
                                                    <?php 
                                                        foreach($categories as $cat){
                                                            if($cat->id==$kategori){
                                                                $selected="selected";
                                                            }else{
                                                                $selected="";
                                                            }
                                                            echo '<option value="'.$cat->id.'" '.$selected.'>'.$cat->category_name.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Topic</label>
                                                <input type="text" name="topic" class="form-control" value="<?php echo $topic; ?>" placeholder="type your title">
                                            </div>
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi</label>
                                                <?php echo $this->wilayah->generateSelectProvinsi($provinsi) ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="kota">City/Kota</label>
                                                <?php echo $this->wilayah->generateSelectKota($provinsi, $kabkota) ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <?php echo $this->wilayah->generateSelectKecamatan($provinsi, $kabkota, $kecamatan) ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="desa">Desa</label>
                                                <?php echo $this->wilayah->generateSelectDesa($provinsi, $kabkota, $kecamatan, $desa) ?>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">UPDATE TOPIC</button>
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
                            <div class="widget">
                                <div class="widget-categories">
                                    <div class="widget-categories-heading">
                                        <h4>Categories</h4>
                                    </div>
                                    <div class="widget-categories-content">
                                        <div class="list-group">
                                            <?php if(isset($category)){$activeSide='';}else{ $activeSide='active';} ?>
                                            <?php echo anchor('thread/', '<span class="label label-default label-pill pull-right"> '.count($threadSide).'</span> All Categories', 'class="list-group-item '.$activeSide.'"'); ?>
                                            <?php 
                                                foreach($categoriesSide as $c){
                                                    if(isset($category) AND $category == $c->category_name){$active='active';}else{$active='';}
                                                    echo anchor('thread/category/'.$c->id, '<span class="label label-default label-pill pull-right">'.countThreadCategories($threadSide, $c->id).'</span> '.$c->category_name, 'class="list-group-item '.$active.'"');
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget">
                                <div class="widget-categories">
                                    <div class="widget-categories-heading">
                                        <h4>Your Topics</h4>
                                    </div>
                                    <div class="widget-categories-content">
                                        <div class="list-group">
                                            <?php 
                                                foreach($topics as $top){
                                                    if($top->id == $idTopic){ $a='active'; }else{ $a=''; }
                                                    echo anchor('#', $top->topic, 'class="list-group-item '.$a.'"');
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<?php get_footer('private'); ?>