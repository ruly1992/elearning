<br>

<?php echo show_message() ?>

<?php echo form_open_multipart('dashboard/update/' . $user->id); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Credentials</strong></h2>
            </div>
            <div class="panel-body">  
                <div class="text-center">
                    <div class="panel-body">
                        <div class="avatar thumbnail" style="max-width: 200px;">
                            <?php if (auth()->getUser()->profile->avatar): ?>
                                <img class="featured-preview" src="<?php echo base_url("public/user/avatar/")."/".auth()->getUser()->profile->avatar ?>" width="100%" id="featured">
                                <img class="featured-preview-default" src="<?php echo asset('images/default_avatar_male.jpg') ?>" style="display: none;">
                            <?php else: ?>
                                <img class="featured-preview" src="<?php echo asset('images/default_avatar_male.jpg') ?>" width="100%" id="featured">
                            <?php endif ?>
                            <input type="hidden" name="avatar" value="<?php echo auth()->getUser()->profile->avatar ?>">
                        </div> 
                    </div>
                    <div class="form-group">
                        <br/>
                        <input type="file" name="avatar" value="" id="preview">
                    </div>
                </div>                
                <div class="form-group">
                    <label for="email">Username</label>
                    <p class="text-static">
                        <?php echo form_input('username', set_value('username', $user->username), array('class' => 'form-control', 'placeholder' => 'Your Username')); ?>
                    </p>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <?php echo form_input('email', set_value('email', $user->email), array('class' => 'form-control', 'placeholder' => 'Your Email')); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="text-static">
                    	<a href="<?php echo site_url('dashboard/changepassword/' . $user->id) ?>" class="btn btn-info"><i class="fa fa-lock"></i> Change Password</a>
                    </div>
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
<br>
<?php echo form_close();?>

<?php custom_script() ?>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#featured').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#preview").change(function(){
            readURL(this);
        });
    </script>
<?php endcustom_script() ?>