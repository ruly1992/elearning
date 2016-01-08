<?php echo show_message() ?>

<?php echo form_open_multipart('dashboard/update/' . $user->id); ?>
<div class="row" id="app-cropit">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                Credentials
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label for="email" class="control-label col-sm-4">Email</label>
                    <div class="col-sm-8">
                        <?php echo form_input('email', set_value('email', $user->email), array('id' => 'email', 'class' => 'form-control')); ?>
                    </div>
                </div>
                <a href="<?php echo site_url('dashboard/changepassword') ?>" class="btn btn-primary"><i class="fa fa-lock"></i> Change Password</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Profile
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-4">                    
                        <cropit-preview
                            name="avatar"
                            :width="192"
                            :height="192"
                            image-src="<?php echo $user->avatar ?>"
                            image-empty="<?php echo asset('images/default_avatar_male.jpg') ?>">
                            <button type="button" class="btn btn-danger" v-on:click="remove('customavatar')" slot="button-remove"><i class="fa fa-trash-o"></i></button>
                        </cropit-preview>
                        <cropit-result name="avatar"></cropit-result>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                                <label for="first_name">First Name</label>
                                <?php echo form_input('first_name', set_value('first_name', $profile->first_name), array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name')); ?>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <?php echo form_input('last_name', set_value('last_name', $profile->last_name), array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
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
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-5">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <?php echo form_input('tempat_lahir', set_value('tempat_lahir', $profile->tempat_lahir), array('id' => 'tempat_lahir', 'class' => 'form-control', 'placeholder' => 'Tempat Lahir')); ?>
                    </div>
                    <div class="col-md-7">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <?php echo form_input('tanggal_lahir', set_value('tanggal_lahir', date('Y-m-d'), $profile->tanggal_lahir), array('id' => 'tanggal_lahir', 'class' => 'form-control input-sm datepicker')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <?php echo form_input('address', set_value('address', $profile->address), array('class' => 'form-control', 'placeholder' => 'Address')); ?>
                </div>
                <div class="form-group">
                    <label for="provinsi">Propinsi</label>
                    <?php echo $this->wilayah->generateSelectProvinsi($user->wilayah['provinsi']) ?>
                </div>
                <div class="form-group">
                    <label for="kota">City/Kota</label>
                    <?php echo $this->wilayah->generateSelectKota($user->wilayah['provinsi'], $user->wilayah['kota']) ?>
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <?php echo $this->wilayah->generateSelectKecamatan($user->wilayah['provinsi'], $user->wilayah['kota'], $user->wilayah['kecamatan']) ?>
                </div>
                <div class="form-group">
                    <label for="desa">Desa</label>
                    <?php echo $this->wilayah->generateSelectDesa($user->wilayah['provinsi'], $user->wilayah['kota'], $user->wilayah['kecamatan'], $user->wilayah['desa']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">
                Save Profile
            </div>
            <div class="card-block">
                <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-save"></i> Update Profile</button>
            </div>
        </div>
    </div>

    <?php $this->load->view('modal/avatar'); ?>
</div>
<?php echo form_close() ?>

<?php custom_stylesheet() ?>
    <link rel="stylesheet" href="<?php echo asset('stylesheets/cropit.css') ?>">
<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <?php $this->load->view('template/vue_cropit'); ?>
    <script src="<?php echo asset('node_modules/vue/dist/vue.min.js') ?>"></script>
    <script src="<?php echo asset('node_modules/cropit/dist/jquery.cropit.js') ?>"></script>
    <script src="<?php echo asset('javascript/cropit.vue.js') ?>"></script>
<?php endcustom_script() ?>