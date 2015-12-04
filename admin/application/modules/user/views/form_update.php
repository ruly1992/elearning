<?php echo form_open('user/saveUpdateProfile/' . $user->id); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Credentials</strong></h2>
            </div>
            <div class="panel-body">                
                <div class="text-center">
                    <div class="avatar thumbnail" style="max-width: 200px;">
                        <?php if ($user->avatar): ?>
                            <img id="avatar-preview" src="<?php echo $user->avatar ?>" width="100%">
                            <img id="avatar-preview-default" src="<?php echo base_url('assets/admin/img/default_avatar_male.jpg') ?>" width="100%" style="display: none;">
                        <?php else: ?>
                            <img id="avatar-preview" src="" width="100%" style="display: none;">
                            <img id="avatar-preview-default" src="<?php echo base_url('assets/admin/img/default_avatar_male.jpg') ?>">
                        <?php endif ?>
                    </div>
                    <div>
                        <a href="<?php echo base_url('filemanager/dialog.php?type=0&field_id=avatar_url') ?>" class="btn btn-default iframe-btn" type="button">Open Filemanager</a>
                        <a href="#" class="btn btn-default btn-remove" data-dismiss="fileinput">Remove</a>
                        <input type="hidden" name="avatar" id="avatar_url" value="<?php echo $user->avatar ?>">
                    </div>
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
                    	<a href="<?php echo site_url('user/changepassword/' . $user->id) ?>" class="btn btn-info"><i class="fa fa-lock"></i> Change Password</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Sebagai</label>
                    <?php echo form_dropdown('role', $role_lists, $user->groups->pluck('id'), array('class' => 'form-control')); ?>
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
               <pre>
               <?php var_dump($user->wilayah['kota']) ?>
               </pre>
               <div class="form-group">
                    <label for="provinsi">Propinsi</label>
                    <?php echo $this->wilayah->generateSelectProvinsi($user->wilayah['provinsi']) ?>
               </div>
                <div class="form-group" class="form-control">
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
            <div class="panel-footer">
                <?php echo button_save() ?>
            </div>
        </div>
    </div>
</div>
<?php
echo form_close();

?>

<script>
    var avatar_default  = jQuery('#avatar-preview-default');
    var avatar          = jQuery('#avatar-preview');

    function responsive_filemanager_callback (field_id) {
        var field   = jQuery('#'+field_id);
        var url     = field.val();
        var img     = jQuery('<img>', {id: 'avatar-preview', width: '100%', src: url});
        
        avatar_default.hide()
        avatar.attr('src', url).show()
    }

    jQuery('.btn-remove').on('click', function () {
        jQuery('#avatar_url').val('')
        avatar.hide()
        avatar_default.show()
    })
</script>
