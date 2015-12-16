<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $media->file_name ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <a href="#" class="thumbnail">
                    <img src="http://lorempixel.com/300/300" alt="">
                </a>
            </div>
            <div class="col-md-9">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Meta Name</th>
                            <th>Meta Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < 3; $i++): ?>
                        <tr>
                            <td><?php echo form_dropdown('meta['.$media->id.'][name][]', ['Filename', 'NSBN', 'Title'], null, ['class' => 'form-control']); ?></td>
                            <td><?php echo form_input('meta['.$media->id.'][value][]', '', ['class' => 'form-control']); ?></td>
                        </tr>
                        <?php endfor ?>
                        <tr>
                            <td colspan="2"><a href="#" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Meta...</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>