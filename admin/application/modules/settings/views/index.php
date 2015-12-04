<?php echo form_open_multipart('settings/save'); ?> 
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-gear"></i><span class="break"></span>Settings</h2>
                <ul class="nav tab-menu nav-tabs" id="myTab">
                    <li class="active"><a href="ui-elements.html#general">General Settings</a></li>
                    <li><a href="ui-elements.html#homepage">Home Page</a></li>
                    <li><a href="ui-elements.html#privatepage">Private Page</a></li>
                    <li><a href="ui-elements.html#medsos">Social Network</a></li>
                </ul>
            </div>
            <div class="panel-body">                
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="general">
                        <p>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><strong>General Setting</strong></h2>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label">Site Title</label>
                                <div class="controls">
                                    <div class="form-group">
                                        <?php echo form_input('title', $this->Mod_settings->get('title'), array('class' => 'form-control', 'placeholder' => 'Site Title')); ?>
                                    </div>                        
                                </div>
                                <label class="control-label">Tagline</label>
                                <div class="controls">
                                    <div class="form-group">
                                        <?php echo form_input('tagline', $this->Mod_settings->get('tagline'), array('class' => 'form-control', 'placeholder' => 'Tagline')); ?>
                                    </div>
                                </div>
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <div class="form-group">
                                        <?php echo form_input('email', $this->Mod_settings->get('email'), array('class' => 'form-control', 'placeholder' => 'email')); ?>
                                    </div>
                                </div>
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <div class="form-group">
                                        <?php echo form_input('description', $this->Mod_settings->get('description'), array('class' => 'form-control', 'placeholder' => 'description')); ?>
                                    </div>
                                </div>                                
                                <div class="panel-footer">
                                    <?php echo button_save() ?>
                                </div>
                            </div>
                        </div>
                        </div>
                        </p>
                    </div>

                     <div class="tab-pane" id="homepage">
                        <p>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><strong>Setting Homepage</strong></h2>
                        </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label">Homepage Category 1</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('homepage_category_1', $kategori_lists, $this->Mod_settings->get('homepage_category_1'), array('class' => 'form-control')); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Homepage Category 2</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('homepage_category_2', $kategori_lists, $this->Mod_settings->get('homepage_category_2'), array('class' => 'form-control')); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Homepage Category 3</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('homepage_category_3', $kategori_lists, $this->Mod_settings->get('homepage_category_3'), array('class' => 'form-control')); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Homepage Category 4</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('homepage_category_4', $kategori_lists, $this->Mod_settings->get('homepage_category_4'), array('class' => 'form-control')); ?>
                                    </div>
                                </div>                                
                                <div class="panel-footer">
                                    <?php echo button_save() ?>
                                </div>
                            </div>
                        </div>
                        </p>
                    </div>

                    <div class="tab-pane" id="medsos">
                        <p>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2><strong>Social Network</strong></h2>
                            </div>
                             <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label social facebook"><a href="<?php echo $this->Mod_settings->get('facebook') ?>">Facebook</a></label>
                                    <div class="controls">
                                        <?php echo form_input('facebook', $this->Mod_settings->get('facebook'), array('class' => 'form-control', 'placeholder' => 'Facebook')); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label social twitter"><a href="<?php echo $this->Mod_settings->get('twitter') ?>">Twitter</a></label>
                                    <div class="controls">
                                        <?php echo form_input('twitter', $this->Mod_settings->get('twitter'), array('class' => 'form-control', 'placeholder' => 'Twitter')); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label social youtube"><a href="<?php echo $this->Mod_settings->get('youtube') ?>">Youtube</a></label>
                                    <div class="controls">
                                        <?php echo form_input('youtube', $this->Mod_settings->get('youtube'), array('class' => 'form-control', 'placeholder' => 'Youtube')) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <?php echo button_save() ?>
                            </div>
                        </div>
                        </p>
                    </div>
                    
                    <div class="tab-pane" id="privatepage">
                        <p>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2><strong>Setting Private Page</strong></h2>
                            </div>
                             <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label">Privatepage Slider</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('privatepage_slider', $kategori_lists, $this->Mod_settings->get('privatepage_slider'), array('class' => 'form-control')); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Privatepage Category 1</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('privatepage_category_1', $kategori_lists, $this->Mod_settings->get('privatepage_category_1'), array('class' => 'form-control')); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Privatepage Category 2</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('privatepage_category_2', $kategori_lists, $this->Mod_settings->get('privatepage_category_2'), array('class' => 'form-control')); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Privatepage Category 3</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('privatepage_category_3', $kategori_lists, $this->Mod_settings->get('privatepage_category_3'), array('class' => 'form-control')); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Privatepage Category 4</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('privatepage_category_4', $kategori_lists, $this->Mod_settings->get('privatepage_category_4'), array('class' => 'form-control')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <?php echo button_save() ?>
                            </div>
                        </div>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div><!--/col-->
</div>

<?php echo form_close(); ?>

<script>
    function responsive_filemanager_callback (field_id) {
        var field   = jQuery('#'+field_id);
        var url     = field.val();
        var img     = jQuery('<img>', {id: 'featured-preview', width: '100%', src: url});

        var featured_default  = field.parents('.panel-body').find('.featured-preview-default');
        var featured          = field.parents('.panel-body').find('.featured-preview');
        
        featured_default.hide()
        featured.attr('src', url).show()
    }

    jQuery('.btn-remove').on('click', function () {
        field = $(this).parent().find('[type=hidden]')
        field.val('')

        var featured_default  = field.parents('.panel-body').find('.featured-preview-default');
        var featured          = field.parents('.panel-body').find('.featured-preview');

        featured.hide()
        featured_default.show()
    })
</script>