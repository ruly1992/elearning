<?php echo form_open('profile'); ?>
<div class="row" id="app-cropit">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Credentials</strong></h2>
            </div>
            <div class="panel-body">                
                <div class="text-center">
                    <cropit-preview
                        name="avatar"
                        :width="192"
                        :height="192"
                        image-src="<?php echo $user->avatar ?>"
                        image-empty="<?php echo asset('images/default_avatar_male.jpg') ?>">
                        <button type="button" class="btn btn-danger btn-margin-btm" v-on:click="remove('customavatar')" slot="button-remove"><i class="fa fa-trash-o"></i></button>
                    </cropit-preview>
                    <cropit-result name="avatar"></cropit-result>
                </div>

                <div class="form-group">
                    <label for="email">Username</label>
                    <p class="text-static">
                        <?php echo $user->username ?>
                    </p>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <?php echo form_input('email', set_value('email', $user->email), array('class' => 'form-control', 'placeholder' => 'Your Email')); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="text-static">
                    	<a href="<?php echo site_url('profile/changepassword') ?>" class="btn btn-info"><i class="fa fa-lock"></i> Change Password</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Sebagai</label>
                    <p class="text-static"><?php echo $user->roles->implode('name', ', ') ?></p>
               </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Profile</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="">First Name</label>
                    <?php echo form_input('first_name', set_value('first_name', $profile->first_name), array('class' => 'form-control', 'placeholder' => 'First Name')); ?>
               </div>
               <div class="form-group">
                    <label for="">Last Name</label>
                    <?php echo form_input('last_name', set_value('last_name', $profile->last_name), array('class' => 'form-control', 'placeholder' => 'Last Name')); ?>
               </div>
               <div class="form-group">
                    <label for="">Gender</label>
                    <div class="radio">
                        <label>
                            <?php echo form_radio('gender', 'male', set_value('gender', $profile->gender) == 'male') ?> Male
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <?php echo form_radio('gender', 'female', set_value('gender', $profile->gender) == 'female') ?> Female
                        </label>
                    </div>
               </div>
               <div class="form-group">
                    <label for="">Tempat Lahir</label>
                    <?php echo form_input('tempat_lahir', set_value('tempat_lahir', $profile->tempat_lahir), array('class' => 'form-control', 'placeholder' => 'Tempat Lahir')); ?>
               </div>
                
                <div class="form-group">
                    <label for="">Tanggal Lahir</label>
                    <?php echo form_input('tanggal_lahir', set_value('tanggal_lahir', date('Y-m-d'), $profile->tanggal_lahir), array('class' => 'form-control input-sm datepicker')); ?>
               </div>

               <div class="form-group">
                    <label for="">Alamat</label>
                    <?php echo form_input('address', set_value('address', $profile->address), array('class' => 'form-control', 'placeholder' => 'Address')); ?>
               </div>
               <div class="form-group">
                    <label for="provinsi">Propinsi</label>
                    <?php echo $this->wilayah->generateSelectProvinsi($profile->wilayah['provinsi']) ?>
               </div>
                <div class="form-group" class="form-control">
                    <label for="kota">City/Kota</label>
                    <?php echo $this->wilayah->generateSelectKota($profile->wilayah['provinsi'], $profile->wilayah['kota']) ?>
               </div>
               <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <?php echo $this->wilayah->generateSelectKecamatan($profile->wilayah['provinsi'], $profile->wilayah['kota'], $profile->wilayah['kecamatan']) ?>
               </div>
               <div class="form-group">
                    <label for="desa">Desa</label>
                    <?php echo $this->wilayah->generateSelectDesa($profile->wilayah['provinsi'], $profile->wilayah['kota'], $profile->wilayah['kecamatan'], $profile->wilayah['desa']) ?>
               </div>
            </div>
            <div class="panel-footer">
                <?php echo button_save() ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('modal/avatar'); ?>
</div>
<?php echo form_close(); ?>

<?php custom_stylesheet() ?>
    <link rel="stylesheet" href="<?php echo asset('stylesheets/cropit.css') ?>">
<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <?php $this->load->view('template/vue_cropit'); ?>
    <script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/cropit/dist/jquery.cropit.js') ?>"></script>
    <script src="<?php echo asset('javascript/cropit.vue.js') ?>"></script>
<?php endcustom_script() ?>
