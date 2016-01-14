<div class="row">
    <div class="col-md-6">
        <?php if(validation_errors()) { ?>
            <div class="alert alert-warning">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>


        <?php if($this->session->flashdata('item')) { ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('item'); ?>
            </div>
        <?php }else if($this->session->flashdata('invalid')){
            ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('invalid'); ?>
            </div>
        <?php
        } ?>
        <form action="" method="post">
            <div class="form-group">
                <div class="col-md-4">
                    <label>Tags</label>
                </div>
                <div class="col-md-8">
                    <?php  $resTag = isset($data[0]['tag']) ? $data[0]['tag'] : ''; ?>
                    <input type="text" name="tag" class="form-control" value="<?php echo set_value('tag',$resTag); ?>"><br/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?=site_url('tags/')?>" class="btn btn-danger">Batal</a>
                </div>
            </div>
        </form>
        <div class="col-md-12 text-left">
            
        </div>
    </div>
</div>