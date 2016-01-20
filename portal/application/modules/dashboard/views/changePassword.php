<?php echo form_open('dashboard/changepassword'); ?>
<?php echo show_message() ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header font-weight-bold">
                Change Password
            </div>
            <div class="card-block">
                <div class="form-group">
                    <label>New Password</label>
                    <?php echo form_password('password', '', array('class' => 'form-control', 'placeholder' => 'New Password')); ?>
                </div>
                <div class="form-group">
                    <label>New Password Confirmation</label>
                    <?php echo form_password('password_confirmation', '', array('class' => 'form-control', 'placeholder' => 'New Password Confirmation')); ?>
                </div>
                <div class="form-group">
                    <label>Old Password</label>                    
                    <?php echo form_password('password_old', '', array('class' => 'form-control', 'placeholder' => 'Old Password')); ?>
                </div>
            </div>
            <div class="card-footer">
                <?php echo button_save('Save a new password') ?>
                <a href="<?php echo site_url('dashboard/profile') ?>" class="btn btn-warning btn-margin-btm">Cancel</a>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php echo form_close();
?>