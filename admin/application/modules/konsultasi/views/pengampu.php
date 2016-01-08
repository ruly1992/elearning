<div class="row">
    <div class="col-md-4">
        <?php echo form_open('konsultasi/pengampu_tambah'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Tambah Data Pengampu</strong></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name">Tenaga Ahli</label>
                    <?php echo form_dropdown('user_id', $users, '', array('class' => 'form-control select2')); ?>
                </div>
                <div class="form-group">
                    <label for="description">Kategori</label>
                   <?php echo form_dropdown('id_kategori', $kategori_list, '', array('class' => 'form-control select2')); ?>
                </div>
            </div>
            <div class="panel-footer">
                <?php echo button_save() ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Daftar Pengampu</strong></h2>
            </div>
            <?php if ($getKategori->count()): ?>
                <div class="panel-body">     
                    <table class="table table-hover table-bordered" id="konsultasi">
                        <thead>
                            <tr>
                                <th>Tenaga</th>
                                <th>Kategori</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getKategori as $row): ?>
                                <?php
                                $i = 0;

                                foreach ($row['categories'] as $category):
                                    if ($i == 0):
                                ?>
                                    <tr>
                                        <td rowspan="<?php echo $row['count'] ?>"><?php echo $row['user']->full_name ?><br><small><?php echo $row['user']->email ?></small></th>
                                        <td><?php echo $category->name ?></td>
                                        <td> <?php echo button_delete('konsultasi/deletePengampu/' . $category->id) ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td><?php echo $category->name ?></td>
                                        <td> <?php echo button_delete('konsultasi/deletePengampu/' . $category->id) ?></td>
                                    </tr>
                                <?php endif; ?>


                                <?php $i++; endforeach; ?>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <nav class="pull-right">
                        <ul class="#">
                            <?php echo $getKategori->render() ?>
                        </ul>
                    </nav>
                </div>
            <?php else: ?>
                <p class="alert alert-warning">Belum ada data</p>
            <?php endif ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        //$('#konsultasi').DataTable();
    } );
</script>
