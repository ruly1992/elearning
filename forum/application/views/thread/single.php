<?php custom_stylesheet(); ?>
<link rel="stylesheet" href="<?php echo asset('plugins/sceditor/minified/themes/default.min.css'); ?>" type="text/css" media="all" />
<?php endcustom_stylesheet(); ?>
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
                                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                                <li><a href="#"><?php echo $category; ?></a></li>
                                <li class="active"><?php echo $title; ?></li>
                            </ol>

                            <?php 
                                if(isset($failed)){
                                    echo '<div class="alert alert-danger">';
                                        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                        echo '<strong>Warning!</strong> '.$failed;
                                    echo '</div>';
                                }elseif(isset($success)){
                                    echo '<div class="alert alert-info">';
                                        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                        echo '<strong>Success!</strong> '.$success;
                                    echo '</div>';
                                }
                            ?>

                            <div class="forum-main">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="card-header-img">
                                                    <img src="<?php echo asset('images/portal/people-1.png'); ?>" alt="">
                                                    <p><small><a href="#">@chanchandrue <?php echo $user; ?></a></small></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="card-header-meta pull-right">
                                                    <p><?php echo $tanggal; ?> <i class="fa fa-calendar"></i></p>
                                                    <p><?php echo $countReply; ?> <i class="fa fa-comments"></i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="card-block-title">
                                            <h4><?php echo $title; ?></h4>
                                        </div>
											<img src="<?php echo asset('images/portal/img-carousel.jpg');?>" class="img-fluid" alt="">
											<p>
                                                <?php echo $message; ?>
                                            </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-sm btn-reply">Reply Post</a>
                                    </div>
                                </div>
                                <?php 
                                    foreach($reply as $r){
                                ?>
                                <div class="card" id="<?php echo $r->id; ?>">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="card-header-img">
                                                    <img src="<?php echo asset('images/portal/people-1.png');?>" alt="">
                                                    <p><small><a href="#">@chanchandrue</a></small></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="card-header-meta pull-right">
                                                    <p><?php echo $r->created_at; ?> <i class="fa fa-calendar"></i></p>
                                                    <!--<p>201 <i class="fa fa-comments"></i></p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <p><?php echo BBCodeParser($r->message); ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-sm btn-reply">Quote Reply</a>
                                    </div>
                                </div>
                                <?php      
                                    }
                                ?>
                                <div class="card">
                                    <div class="card-header">
                                         <p>in reply to : <a href="#"><?php echo $title; ?></a></p>
                                    </div>
                                    <div class="card-block">
                                       
                                        <?php echo form_open('thread/replyThread/'.$id); ?>
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" class="form-control" required name="title" required placeholder="type your title">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Message</label>
                                                <textarea name="message" required id="" cols="30" rows="10" class="form-control" placeholder="type your message"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-post">POST REPLY</button>
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

<?php custom_script(); ?>
    <script src="<?php echo asset('plugins/sceditor/development/jquery.sceditor.bbcode.js'); ?>"></script>
    <script>
        $(function() {
            $("textarea").sceditor({
                plugins: "bbcode",
                style: "<?php echo asset('plugins/sceditor/development/jquery.sceditor.default.min.css'); ?>" ,
                emoticonsRoot : "<?php echo asset('plugins/sceditor/'); ?>"
            });
        });
    </script>
<?php endcustom_script() ?>
<?php get_footer('private') ?>