<?php get_header('default') ?>

    <!-- start:main content -->
    <div class="container content content-single">
        <section id="content">
            
            <div class="login">
                <div class="login-logo">
                    <div class="text-center">
                        <a href="<?php echo home_url() ?>"><img src="<?php echo asset('images/logo.png') ?>" alt=""></a>
                    </div>
                </div>
                <div class="login-form">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs12">
                            <?php echo show_message() ?>
                            <?php echo form_open('reset/reset_password/'.$id.'/'.$code); ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
                                        <input type="password" name="password" class="form-control input-lg" placeholder="Input your new password" aria-describedby="basic-addon1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control input-lg" placeholder="Input your confirm password" aria-describedby="basic-addon1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-lg btn-login">Submit</button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <!-- end:main content -->

<?php get_footer('default') ?>
