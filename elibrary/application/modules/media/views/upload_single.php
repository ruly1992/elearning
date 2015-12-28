
<?php echo form_open('media/addMeta/'.count($files)); ?>
<?php 
    for($i=0; $i<count($files); $i++){
        foreach($files[$i] AS $file){
?>
    <div id="app-meta<?php echo $i; ?>">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $file->file_name ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">

                        <div class="description-meta-left">
                            <div class="text-center">
                                <div class="preview-media" style="width: 200px; height: 200px;">
                                    <?php echo $media->getPreview(200, 200) ?>
                                </div>
                                <br>
                                <br>
                                <span><?php echo $media->icon ?> <?php echo $media->type ?></span>
                            </div>
                            <div class="description-meta-button">
                                <a href="<?php echo $media->getLinkDownload() ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-download"></i> Download</a>
                                <a href="<?php echo $media->getLinkPreview() ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-eye"></i> Preview</a>
                            </div>
                        </div>

                        <!-- <a href="#" class="thumbnail">
                            <img src="http://lorempixel.com/150/150" alt="">
                        </a> -->
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
                                        <input type="text" name="meta<?php echo $i; ?>[{{ meta.key }}]" value="{{ meta.value }}" class="form-control">
                                    </td>
                                    <td><a href="#" onclick="return false" class="btn btn-danger btn-sm" v-on:click="removeMeta($index)"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-10   ">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control awesomplete" v-validate="required" v-model="key">
                                        <span v-show="$validation1.meta.required">Meta harus diisi.</span>
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
        </div>
    </div>
<?php 
        }
    }
?>
    <div>
        <button type="submit" class="btn btn-primary">Simpan Meta</button>
    </div>
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
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="<?php echo asset('plugins/jQuery.filer-1.0.5/js/jquery.filer.min.js?v=1.0.5') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('javascript/jquery.filer.custom.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('node_modules/vue/dist/vue.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('node_modules/vue-validator/dist/vue-validator.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('node_modules/awesomplete/awesomplete.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('javascript/elib.js'); ?>"></script>
    <?php 
        for($a=0; $a<count($files); $a++){
    ?>
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

                            this.metadata.push({
                                key: key,
                                value: ''
                            })

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