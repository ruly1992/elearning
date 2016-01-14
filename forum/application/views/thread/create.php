<?php custom_stylesheet(); ?>
<link rel="stylesheet" href="<?php echo asset('plugins/sceditor/minified/themes/default.min.css'); ?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo asset('plugins/customselect/css/jquery-customselect-1.9.1.css'); ?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo asset('plugins/chosen_v1.4.2/chosen.css'); ?>" type="text/css" media="all" />
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
                                <li class="active"><?php echo $breadcrumb; ?></li>
                            </ol>

                            <div class="forum-main">
                                <div class="card">
                                    <div class="card-block">
                                       
									   <?php echo form_open('thread/post'); ?>
                                        <!--<form action="">-->
                                            <div class="form-group">
                                                <label for="">Pilih Kategori :</label>
                                                <select class="c-select form-control" id="category" required name="kategori">
                                                    <option value="">Pilih kategori</option>
                                                    <?php 
														foreach($categories as $cat){
															echo '<option value="'.$cat->id.'" >'.$cat->category_name.'</option>';
														}
													?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Pilih Topic :</label>
                                                <select class="c-select form-control" id="topic" required name="topic">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Pilih Type Thread :</label>
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
                                            <div class="form-group collapse" id="addPrivate">
                                                <label>Pilih anggota</label>
                                                <select id="addMember" data-placeholder="Pilih anggota ..." class="form-control chosen-select" multiple name="member[]" tabindex="4">
                                                    <?php usersOption($users) ?>
                                                </select>
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
                                                <button type="submit" class="btn btn-primary" onclick="validate()">Create New Thread</button>
                                                <?php echo anchor('thread/', 'Cancel', 'class="btn btn-secondary"') ?>
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
    <script src="<?php echo asset('plugins/sceditor/development/jquery.sceditor.bbcode.js'); ?>"></script>
    <script src="<?php echo asset('plugins/customselect/js/jquery-customselect-1.9.1.js'); ?>"></script>
    <script src="<?php echo asset('plugins/chosen_v1.4.2/chosen.jquery.min.js'); ?>"></script>
    <script>
        $(function() {
            $("textarea").sceditor({
                plugins: "bbcode",
                style: "<?php echo asset('plugins/sceditor/development/jquery.sceditor.default.css'); ?>" ,
                emoticonsRoot : "<?php echo asset('plugins/sceditor/'); ?>"
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#category').change(function(){
                var category_id = $('#category').val();
                if (category_id != ""){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('/thread/get_topics'); ?>",
                        data :"idCategory="+category_id,
                        success: function( data ) {
                            $( '#topic' ).html(data);
                        }
                    }); 
                } else {
                    $('#topic').empty();
                }
            }); 
        });
    </script>
    <script type="text/javascript">
        function private(){
            $('#addPrivate').collapse('show');
            $('.chosen-select').chosen();
            $('#addMember').attr('required', true);
            $('#addMember').on('change invalid', function() {
                var select = $(this).get(0);
                select.setCustomValidity('');
                
                if (!select.validity.valid) {
                    select.setCustomValidity('Daftar anggota tidak boleh kosong');  
                }
            });
        }

        function public(){
            $('#addPrivate').collapse('hide');
        }
    </script>
<?php endcustom_script() ?>
<?php get_footer('private') ?>