<?php custom_stylesheet(); ?>
<link rel="stylesheet" href="<?php echo asset('plugins/sceditor/minified/themes/default.min.css'); ?>" type="text/css" media="all" />
<?php endcustom_stylesheet(); ?>
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
                                <li><a href="<?php if(isset($home)){ echo $home; }else{ echo site_url(); } ?>">Home</a></li>
                                <li>
                                    <?php 
                                        if(isset($home)){ $controller=$home; }else{ $controller='thread'; }
                                        echo anchor( $controller.'/category/'.$idCategory, $category); 
                                    ?>
                                </li>
                                <li class="active"><?php echo $topic; ?></li>
                            </ol>

                            <?php 
                                if(isset($failed)){
                                    echo '<div class="alert alert-danger">';
                                        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                        echo '<strong>Warning!</strong> '.$failed;
                                    echo '</div>';
                                }elseif(isset($success)){
                                    echo '<div class="alert alert-ytopic">';
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
                                                    <p><small><a href="#"><?php echo user($user)->full_name; ?></a></small></p>
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
                                        <?php if($status=='1'){ ?>
                                            <a href="#replyThread" class="btn btn-sm btn-reply" data-toggle="collapse" >Reply Post</a>
                                            <p></p>
                                            <div class="card collapse" id="replyThread">
                                                <div class="card-header">
                                                     <p>in reply to : <a href="#"><?php echo $title; ?></a></p>
                                                </div>
                                                <div class="card-block">
                                                   
                                                    <?php echo form_open('thread/replyThread/'.$id); ?>
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
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if($status=='1'){ ?>
                                        
                                <?php } ?>
                                <?php foreach($reply as $r){ ?>
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
                                        <a href="#reply<?php echo $r->id; ?>" class="btn btn-sm btn-reply" data-toggle="collapse">Quote Reply</a>
                                        <p></p>
                                            <div class="card collapse" id="reply<?php echo $r->id; ?>">
                                                <div class="card-header">
                                                     <p>in reply to : <a href="#"><?php echo $r->title; ?></a></p>
                                                </div>
                                                <div class="card-block" id="form-reply">
                                                   
                                                    <?php echo form_open('thread/replyThread/'.$id); ?>
                                                        <div class="form-group">
                                                            <label for="">Message</label>
                                                            <textarea name="message" required id="" cols="30" rows="10" class="form-control" placeholder="type your message"><?php echo '[quote=Quote Reply]'.$r->message.'[/quote]'; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-post">POST REPLY</button>
                                                        </div>
                                                    <?php echo form_close(); ?>

                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <?php } ?>
                                
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
    <script src="<?php echo asset('plugins/sceditor/development/jquery.sceditor.bbcode.js'); ?>"></script>
    <script>
        $(function() {
           var cardWidth    = $("div .card-block").width();
           var bbcodeWidth  = cardWidth - 40;
           var bbcodeHeight = bbcodeWidth / 2;
            $("textarea").sceditor({
                plugins: "bbcode",
                style: "<?php echo asset('plugins/sceditor/development/jquery.sceditor.default.css'); ?>" ,
                emoticonsRoot : "<?php echo asset('plugins/sceditor/'); ?>",
                width:bbcodeWidth,
                height:bbcodeHeight
            });
        });
    </script>
<?php endcustom_script() ?>
<?php get_footer('private') ?>