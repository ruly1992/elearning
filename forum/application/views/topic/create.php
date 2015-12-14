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
                                                <input type="text" name="topic" class="form-control" placeholder="type your title">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Pilih Daerah :</label>
                                                <select class="c-select form-control" name="daerah">
                                                    <?php
                                                        foreach($provinsi as $kode=>$nama){
                                                            echo '<option value="'.$kode.'">'.$nama.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-post">CREATE NEW TOPIC</button>
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
                                            <a href="#" class="list-group-item active">
                                                <span class="label label-default label-pill pull-right">14</span> All Categories
                                            </a>
                                            <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> Video Conferences</a>
                                            <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> Kelas Online</a>
                                            <a href="#" class="list-group-item"><span class="label label-default label-pill pull-right">14</span> E-Library</a>
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

<?php get_footer(); ?>