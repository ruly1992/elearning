<div class="login">
    <div class="login-logo">
        <div class="text-center">
            <a href="#"><img src="<?php echo asset('images/portal/logo-login.png') ?>" alt=""></a>
        </div>
    </div>
    <div class="login-form">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-12 col-xs12">
            	<?php echo show_message() ?>
                <?php echo form_open('login'); ?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="username"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="email" class="form-control input-lg" placeholder="Input your email" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="password"><i class="fa fa-key"></i></span>
                            <input type="password" name="password" class="form-control input-lg" placeholder="Input your password" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-login">LOGIN</button>
                    </div>
                    <div class="form-group">
                        <p><small>Lost your pasword? <a href="<?php echo site_url('reset') ?>">Reset Password</a></small></p>  
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>