<style>
    div.awesomplete {
        display: block;
    }
    div.awesomplete > ul {
        margin-top: 45px;
    }
</style>
<?php 
    for($i=0; $i<count($files); $i++){
        foreach($files[$i] AS $file){
?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $file->file_name ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="#" class="thumbnail">
                            <img src="http://lorempixel.com/150/150" alt="">
                        </a>
                    </div>
                    <div class="col-md-9">
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
                                    <td><input name="title<?php echo $i; ?>" class="form-control"></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>File Size</td>
                                    <td><?php echo $file->file_size; ?> Kb</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td><textarea name="deskripsi<?php echo $i; ?>" class="form-control"></textarea></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr v-for="meta in metadata">
                                    <td>{{ meta.key }}</td>
                                    <td><input type="text" name="meta[{{ meta.key }}]" value="{{ meta.value }}" class="form-control"></td>
                                    <td><a href="#" onclick="return false" class="btn btn-danger btn-sm" v-on:click="removeMeta($index)"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <!-- <tr>
                                    <td colspan="2">
                                        <input class="form-control awesomplete" aria-autocomplete="list" type="text" autocomplete="off">
                                        <a href="#" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Meta...</a>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-10   ">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control awesomplete" v-model="key">
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

    <script type="text/javascript">
    //     $(function() {
    //             var metaFile = $('#meta<?php echo $file->id; ?>');
    //             var i = $('#p_scents p').size() + 1;
                
    //             $('#addScnt').live('click', function() {
    //                     $('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt_' + i +'" value="" placeholder="Input Value" /></label> <a href="#" id="remScnt">Remove</a></p>').appendTo(scntDiv);
    //                     i++;
    //                     return false;
    //             });
                
    //             $('#remScnt').live('click', function() { 
    //                     if( i > 2 ) {
    //                             $(this).parents('p').remove();
    //                             i--;
    //                     }
    //                     return false;
    //             });
    //     });
    </script>
<?php 
        }
    }
?>

<?php custom_stylesheet() ?>
    <link href="<?php echo asset('/plugins/jQuery.filer-1.0.5/css/jquery.filer.css') ?>" type="text/css" rel="stylesheet" />
<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
    <!--jQuery-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="<?php echo asset('/plugins/jQuery.filer-1.0.5/js/jquery.filer.min.js?v=1.0.5') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/javascript/jquery.filer.custom.js') ?>"></script>
<?php endcustom_script() ?>