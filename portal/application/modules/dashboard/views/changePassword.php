<?php 
echo form_open('dashboard/changepassword/'.$user->id);
?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Change Password</strong></h2>
            </div>
            <div class="panel-body">
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
            <div class="panel-footer">
                <?php echo button_save('Change Password') ?>
            </div>
        </div>
    </div>
</div>
<?php echo form_close();
?>