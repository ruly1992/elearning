<?php echo form_open('media/addMeta/'.count($files)); ?>
    <?php 
        for($i=0; $i<count($files); $i++){
            foreach($files[$i] AS $file){
    ?>
            <div class="card" id="app-meta<?php echo $i ?>" data-media-id="<?php echo $file->id ?>">
                <div class="card-header">
                    <?php echo $file->file_name ?>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="description-meta-left">
                                <div style="text-align:center;" class="img-thumbnail">
                                    <div class="preview-media" style="width:100%; height:auto; border-radius:10px;">
                                        <?php echo $media[$i]->getPreview(200, 180) ?>
                                    </div>
                                    <span><?php echo $media[$i]->icon ?> <?php echo $media[$i]->type ?></span>
                                    <br>
                                </div>
                                <div class="description-meta-button">
                                    <a href="<?php echo $media[$i]->getLinkDownload() ?>" class="btn btn-sm btn-block btn-download"><i class="fa fa-download"></i> Download</a>
                                    <!-- <a href="<?php echo $media[$i]->getLinkPreview() ?>" class="btn btn-sm btn-block btn-preview"><i class="fa fa-eye"></i> Preview</a> -->
                                    <a href="#" class="btn btn-sm btn-block btn-preview" data-toggle="modal" data-target="#preview<?php echo $i ?>"><i class="fa fa-eye"></i> Preview</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <input type="hidden" name="id<?php echo $i; ?>" value="<?php echo $file->id; ?>">
                            <table class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>Meta Name</th>
                                  <th>Meta Value</th>
                                  <th>&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Judul</td>
                                  <td>
                                      <div class="form-group">
                                        <input required name="title<?php echo $i; ?>" class="form-control" placeholder="Judul file">
                                      </div>
                                  </td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>File size</td>
                                  <td><?php echo $file->file_size; ?> Kb</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>Deskripsi</td>
                                  <td><textarea required name="description<?php echo $i; ?>" class="form-control" placeholder="Deskripsi File"></textarea></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr v-for="meta in metadata">
                                    <td>{{ meta.key }}</td>
                                    <td>
                                        <input type="text" name="meta<?php echo $i; ?>[{{ meta.key }}]" required value="{{ meta.value }}" class="form-control" placeholder="Meta value">
                                    </td>
                                    <td><a href="#" onclick="return false" class="btn btn-danger btn-sm" v-on:click="removeMeta($index)"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="form-inline">
                                <div class="form-group">
                                    <label for="addMeta" class="sr-only"></label>
                                    <input type="text" class="form-control form-control-sm" placeholder="Nama meta" v-model="key">
                                </div>
                                <button type="button" class="btn btn-sm btn-primary" v-on:click="addMeta">Tambahkan Meta</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>

            <!-- Start:modal preview -->
            <div class="modal fade" id="preview<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myLargeModalLabel">Preview</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-xs-center" id="modal-content<?php echo $i; ?>">
                            <?php echo $media[$i]->getPreview(500, 'auto') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
            <!-- End:modal preview -->
        <?php 
                }
            }
        ?>
    <button class="btn btn-sm btn-primary" type="submit">Submit</button>
<?php echo form_close(); ?>

<?php custom_stylesheet() ?>
    <link href="<?php echo asset('plugins/jQuery.filer-1.0.5/css/jquery.filer.css') ?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo asset('node_modules/awesomplete/awesomplete.css'); ?>">
    <style type="text/css">
        div.awesomplete {
            display: block;
        }
        div.awesomplete > ul {
            margin-top: 45px;
        }
    </style>
<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <!--jQuery-->
    <!--<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>-->
    <script type="text/javascript" src="<?php echo asset('plugins/jQuery.filer-1.0.5/js/jquery.filer.min.js?v=1.0.5') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('javascript/jquery.filer.custom.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('node_modules/vue/dist/vue.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('node_modules/vue-validator/dist/vue-validator.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('plugins/jquery-validation-1.14.0/dist/jquery.validate.js'); ?>"></script>
    
    <script type="text/javascript">
    </script>

    <?php 
        for($a=0; $a<count($files); $a++){
    ?>
        <script type="text/javascript">
            $('#preview<?php echo $a; ?>').on('hidden.bs.modal', function (e) {
                $('#modal-content<?php echo $a; ?> video').get(0).pause();
            });
        </script>
        <script type="text/javascript">
                new Vue({
                    el: '#app-meta<?php echo $a; ?>',
                    data: {
                        metadata: []
                    },
                    ready: function () {
                        var self = this;
                        var app = this.$el;

                        $.ajax({
                            url: siteurl + 'media/getmetadata',
                            data: {
                                media_id: $(this.$el).data('media-id')
                            },
                            success: function (response) {
                                self.metadata = response
                            }
                        })
                    },
                    methods: {
                        addMeta: function () {
                            var key = this.key;

                            if (key != '' && key != undefined) {
                                this.metadata.push({
                                    key: key,
                                    value: ''
                                })
                            }

                            this.key = '';

                            return false
                        },
                        removeMeta: function (index) {
                            this.metadata.splice(index, 1)
                        }
                    }
                })
        </script>
    <?php } ?>
<?php endcustom_script() ?>