<br>
<?php echo form_open_multipart('dashboard/sendArticle'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">        
            <div class="panel-heading">
                <h4 class="panel-title">Artikel</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo form_input('title', set_value('title'), array('class' => 'form-control input-lg', 'placeholder' => 'Masukkan judul artikel')); ?>
                </div>
                
                <div class="form-group">
                    <?php echo form_textarea('content', set_value('content', '', FALSE), array('class' => 'form-control editor')); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Category</h4>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <?php echo $categories_checkbox ?>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Featured Image</h4>
            </div>
            <div class="panel-body">    
                <div class="form-group">
                    <input type="file" name="featured" value=""></input>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim Artikel</button>
        </div>
    </div>
</div>

<?php echo form_close(); ?>
<br>