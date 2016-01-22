<?php echo form_open('elibrary/addMeta/'.count($files)); ?>
<?php 
    for($i=0; $i<count($files); $i++){
        foreach($files[$i] AS $file){
?>
    <div id="app-meta<?php echo $i; ?>" data-media-id="<?php echo $file->id ?>">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $file->file_name ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="description-meta-left">
                            <div class="text-center">
                                <div class="preview-media" style="width: 100%; height: auto;">
                                    <?php echo $media[$i]->getPreview(150, 150) ?>
                                </div>
                                <br>
                                <span><?php echo $media[$i]->icon ?> <?php echo $media[$i]->type ?></span>
                            </div>
                            <div class="description-meta-button">
                                <a href="<?php echo $media[$i]->getLinkDownload() ?>" class="btn btn-sm btn-block btn-download"><i class="fa fa-download"></i> Download</a>
                                <a class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#myModal-1<?php echo $i ?>"><i class="fa fa-eye"></i> Preview</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <input type="hidden" name="id<?php echo $i; ?>" value="<?php echo $file->id; ?>">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Meta Name</th>
                                    <th>Meta Value</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Title</td>
                                    <td><input required name="title<?php echo $i; ?>" class="form-control" placeholder="Judul file"></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>File Size</td>
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
                                        <input type="text" name="meta<?php echo $i; ?>[{{ meta.key.split(' ').join('_') }}]" required value="{{ meta.value }}" class="form-control" placeholder="Meta value">
                                    </td>
                                    <td><a href="#" onclick="return false" class="btn btn-danger btn-sm" v-on:click="removeMeta($index)"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-10   ">
                                <div class="form-group">
                                    <div class="input-group">
                                            <input type="text" class="form-control awesomplete" placeholder="Nama meta" v-model="key">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-info" v-on:click="addMeta">Tambahkan meta</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="panel-body">
                <button type="submit" class="btn btn-primary">Simpan Meta</button>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal-1<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Preview Media</h4>
                </div>
                <div class="modal-body">
                    <div class="text-xs-center" id="modal-content<?php echo $i; ?>">
                        <?php echo $media[$i]->getPreview(500, 'auto') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
        }
    }
?>
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
    <script type="text/javascript" src="<?php echo asset('node_modules/vue/dist/vue.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('node_modules/vue-validator/dist/vue-validator.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('node_modules/awesomplete/awesomplete.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('javascript/elib.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('plugins/jquery-validation-1.14.0/dist/jquery.validate.js'); ?>"></script>
    
    <script type="text/javascript">
        $().ready(function() {
            $("#metaAdd").validate();
        });
    </script>

    <?php 
        for($a=0; $a<count($files); $a++){
    ?>
        <script type="text/javascript">
            $('#myModal-1<?php echo $a; ?>').on('hidden.bs.modal', function (e) {
                if ( $('#modal-content<?php echo $a; ?> video').length ) {
                    $('#modal-content<?php echo $a; ?> video').get(0).pause();
                }
                if ( $('#modal-content<?php echo $a; ?> audio').length ) {
                    $('#modal-content<?php echo $a; ?> audio').get(0).pause();
                }
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
                            url: siteurl + 'elibrary/getmetadata',
                            data: {
                                media_id: $(app).data('media-id')
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
    
    <script src="<?php echo asset('admin/plugins/modal/js/jquery.modalEffects.js') ?>"></script>
    <script src="<?php echo asset('admin/js/pages/ui-modals.js') ?>"></script>
<?php endcustom_script() ?>