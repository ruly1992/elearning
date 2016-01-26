<?php custom_stylesheet(); ?>
<link rel="stylesheet" href="<?php echo asset('plugins/sceditor/minified/themes/default.min.css'); ?>" type="text/css" media="all" />
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
                                <li class="active">Edit Thread</li>
                            </ol>

                            <div class="forum-main">
                                <div class="card">
                                    <div class="card-block">
                                       
									   <?php echo form_open('thread/update/'.$controller.'/'.$id_thread); ?>
                                        <!--<form action="">-->
                                            <div class="form-group">
                                                <label for="">Pilih Kategori :</label>
                                                <select class="c-select form-control" id="category" required name="kategori">
                                                    <?php 
														foreach($categories as $cat){
															if($cat->id==$kategori){$selected='selected';}else{$selected='';}
															echo '<option value="'.$cat->id.'" '.$selected.'>'.$cat->category_name.'</option>';
														}
													?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Pilih Topic :</label>
                                                <select class="c-select form-control" id="selectTopic" required name="topic">
                                                    <?php 
                                                        foreach($topics as $top){
                                                            if($top->id==$topic){$selected='selected';}else{$selected='';}
                                                            echo '<option value="'.$top->id.'" '.$selected.' >'.$top->topic.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Pilih Type Thread :</label>
                                                <div>
                                                    <label class="c-input c-checkbox">
                                                        <input id="selected" name="type" value="close" <?php if($type=='close'){echo 'checked';} ?> type="checkbox" onclick="private()">
                                                        <span class="c-indicator"></span>
                                                        Close
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group collapse" id="addPrivate">
                                                <label>Pilih anggota</label>
                                                <select id="addMember" data-placeholder="Pilih anggota ..." class="form-control chosen-select" multiple name="member[]" tabindex="4">
 
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" class="form-control" value="<?php echo $title;?>" required name="title" placeholder="type your title">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Message</label>
                                                <textarea name="message" id="" cols="30" rows="10" required class="form-control" placeholder="type your message"><?php echo $message; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">UPDATE THREAD</button>
                                                <?php echo anchor($controller.'/', 'Cancel', 'class="btn btn-secondary"'); ?>
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
    <script src="<?php echo asset('plugins/chosen_v1.4.2/chosen.jquery.min.js'); ?>"></script>
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
    <script type="text/javascript">
        $(document).ready(function(){
            var selected  = $("#selected").prop( "checked");
            if(selected == true){
                private();
            }
            $('#category').change(function(){
                var category_id = $('#category').val();
                if (category_id != ""){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('/thread/get_topics'); ?>",
                        data :"idCategory="+category_id,
                        success: function( data ) {
                            $( '#selectTopic' ).html(data);
                        }
                    }); 
                } else {
                    $('#topic').empty();
                }
            }); 

            $('#selectTopic').change(function(){
                var idTopic     = document.getElementById("selectTopic").value;
                    if (idTopic != ""){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('/thread/getUserByTopic'); ?>",
                            data :"topic="+idTopic,
                            success: function( data ) {
                                $('#addMember').empty();
                                $( '#addMember' ).html(data);
                                $("#addMember").trigger("chosen:updated");
                            }
                        }); 
                    }else{
                        $('#addMember').empty();
                        $("#addMember").trigger("chosen:updated");
                    } 
            });
        });        
    </script>

    <script type="text/javascript">
        function private(){
            var idThread    = "<?php echo $id_thread; ?>";
            var idTopic     = document.getElementById("selectTopic").value;
            var selected    = $("#selected").prop( "checked" );

            if(selected == true){
                if (idTopic != ""){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('/thread/getSelectedMember'); ?>",
                        data :{
                            topic: idTopic,
                            thread: idThread
                        },
                        success: function( data ) {
                            $('#addPrivate').collapse('show');
                            $( '#addMember' ).html(data);
                            $('.chosen-select').chosen();
                            $("#addMember").trigger("chosen:updated");

                            $('#addMember').attr('required', true);
                            $('#addMember').on('change invalid', function() {
                                var select = $(this).get(0);
                                select.setCustomValidity('');
                                
                                if (!select.validity.valid) {
                                    select.setCustomValidity('Daftar anggota tidak boleh kosong');  
                                }
                            });
                        }
                    }); 
                } else {
                    $('#addPrivate').collapse('hide');
                    $('#selected').prop('checked', false);
                    alert("Anda harus memilih topic terlebih dahulu!");
                }
            }else{
                $('#addPrivate').collapse('hide');
                $('#addMember').empty();
                $("#addMember").trigger("chosen:updated");
                $('#addMember').removeAttr('required');
            }
        }
    </script>
<?php endcustom_script() ?>
<?php get_footer('private') ?>