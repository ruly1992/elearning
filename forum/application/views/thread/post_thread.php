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
                                <li class="active"><?php echo $breadcrumb; ?></li>
                            </ol>

                            <div class="forum-main">
                                <div class="card">
                                    <div class="card-block">
                                       
									   <?php echo form_open('thread/postThread'); ?>
                                        <!--<form action="">-->
                                            <div class="form-group">
                                                <label for="">Pilih Kategori :</label>
                                                <select class="c-select form-control" required name="kategori">
                                                    <?php 
														foreach($category as $cat){
															echo '<option value="'.$cat->id.'" >'.$cat->category_name.'</option>';
														}
													?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Pilih Type Thread :</label>
                                                <div>
                                                    <label class="c-input c-radio">
                                                        <input id="radio1" name="radio" value="close" type="radio">
                                                        <span class="c-indicator"></span>
                                                        Close
                                                    </label>
                                                    <label class="c-input c-radio">
                                                        <input id="radio2" name="radio" value="public" checked type="radio">
                                                        <span class="c-indicator"></span>
                                                        Public
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" class="form-control" required name="title" placeholder="type your title">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Message</label>
                                                <textarea name="message" id="" cols="30" rows="10" required class="form-control" placeholder="type your message"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">CREATE NEW THREAD</button>
                                                <?php echo anchor('thread/', 'Cancel', 'class="btn btn-secondary"'); ?>
                                            </div>
                                        </form>
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
                                                    echo anchor('thread/viewAt/'.$c->id, '<span class="label label-default label-pill pull-right">'.countThreadCategories($threadSide, $c->id).'</span> '.$c->category_name, 'class="list-group-item '.$active.'"');
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