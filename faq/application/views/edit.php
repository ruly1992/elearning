<?php get_header('private'); ?>

        <!-- start:main content -->
        <div class="container content-faq">
            <section id="content">

                <!-- start:content -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- start:content main -->
                        <div class="content-main-faq">
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="forum-main">
                                    <div class="card">
                                        <div class="card-block">                                           
                                            <?php echo form_open('/dashboard/update/'.$id, 'id="formFAQ"'); ?>
                                                <div class="form-group">
                                                    <label for="">Title :</label>
                                                    <input type="text" required value="<?php echo $title; ?>" name="title" class="form-control" placeholder="type your title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Pertanyaan :</label>
                                                    <input type="text" required value="<?php echo $pertanyaan; ?>" name="pertanyaan" class="form-control" placeholder="Pertanyaan">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Jawaban :</label>
                                                    <textarea type="text" id="jawaban" name="jawaban" class="jawaban" rows="5" placeholder="Jawaban"><?php echo $jawaban; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" onclick="submitFAQ()" class="btn btn-primary">Update</button>
                                                    <?php echo anchor('dashboard/','Cancel','class="btn btn-default"'); ?>
                                                </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">                                
                            </div>
                        </div>
                        <!-- end:content main -->
                    </div>
                </div>
                <!-- end:content -->

            </section>
        </div>
        <!-- end:main content -->
<?php custom_script(); ?>
        <script src="<?php echo asset('plugins/tinymce/tinymce.min.js'); ?>"></script>
        <script>
                tinymce.init({
                    selector:'.jawaban',
                    plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                            "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
                    ],
                    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                    toolbar2: "| link unlink anchor | image media | forecolor backcolor  | print preview code ",
                    image_advtab: true ,
                    relative_urls: false,
                    remove_script_host : false
                });
        </script>
        <script type="text/javascript">
            function submitFAQ(){
                // Get content of a specific editor:
                var content = tinyMCE.get('jawaban').getContent();
                if(content == '')
                {
                    alert("Jawaban harus diisi!");
                }
                else
                {
                    $("#formFAQ").submit();
                }
            }
        </script>
<?php endcustom_script(); ?>
<?php get_footer('private'); ?>
