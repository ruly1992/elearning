<?php echo form_open('faq/create', 'id="formFAQ"'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="title" name="title" value="<?php echo set_value('title') ?>" class="form-control"><?php echo form_error('title') ?>
                </div>
                <div class="form-group">
                    <label>Pertanyaan</label>
                    <input type="text" id="pertanyaan" name="question" value="<?php echo set_value('question') ?>" class="form-control"><?php echo form_error('question') ?>
                </div>

                <div class="form-group">
                    <label>Jawaban</label>
                    <textarea name="answer" id="editor" rows="4" class="form-control editor"><?php echo set_value('answer') ?></textarea><?php echo form_error('answer') ?> 
                </div>                
                <div class="panel-body">
                    <button type="button" onclick="submitFAQ()" class="btn btn-success btn-md"><i class="fa fa-save"></i> Save FAQ</button>
                    <a href="<?php echo base_url('/faq'); ?>" class="btn btn-warning btn-md">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>

<?php echo form_close(); ?>

<?php custom_script(); ?>
        <script type="text/javascript">
            function submitFAQ(){
                // Get content of a specific editor:
                var jawaban     = tinyMCE.get('editor').getContent();
                var title       = $("#title").val();
                var pertanyaan  = $("#pertanyaan").val();
                if(title == '')
                {
                    alert("Title harus diisi terlebih dahulu!");
                }
                else if(pertanyaan == '')
                {
                    alert("Pertanyaan harus diisi terlebih dahulu!");
                }
                else if(jawaban == '')
                {
                    alert("Jawaban harus diisi terlebih dahulu!");
                }
                else
                {
                    $("#formFAQ").submit();
                }
            }
        </script>
<?php endcustom_script(); ?>