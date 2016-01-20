<?php echo form_open('faq/update/' . $data->id, 'id="formFAQ"'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>FAQ</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="">Title</label>
                    <?php echo form_input('title', set_value('title', $data->title), array('class' => 'form-control', 'id' => 'title')); ?>
               </div>
                <div class="form-group">
                    <label for="">Pertanyaan</label>
                    <?php echo form_input('question', set_value('question', $data->question), array('class' => 'form-control', 'id' => 'pertanyaan')); ?>
               </div>
               <div class="form-group">
                    <label for="">Jawaban</label>
                    <?php echo form_textarea('answer', set_value('answer', $data->answer, FALSE), array('class' => 'form-control editor', 'id' => 'editor')); ?>
               </div>
            </div>
            <div class="panel-footer">
                    <button type="button" onclick="submitFAQ()" class="btn btn-success btn-md"><i class="fa fa-save"></i> Update FAQ</button>
            </div>
        </div>
    </div>
</div>
<?php
echo form_close();
?>

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