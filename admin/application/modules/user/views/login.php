<?php echo form_open('user/login') ?>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
            <?php echo form_input('username', set_value('username'), array('class' => 'form-control input-lg', 'placeholder' => 'Masukkan Username', 'aria-describedby="basic-addon1')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
            <?php echo form_password('password', '', array('class' => 'form-control input-lg', 'placeholder' => 'Masukkan Password', 'aria-describedby="basic-addon1')); ?>                        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-block btn-lg btn-login">Login</button>
    </div>
    <div class="form-group">
        <p><small>Lost your pasword? <a href="#">Reset Password</a></small></p>  
    </div>                    
<?php echo form_close() ?>
