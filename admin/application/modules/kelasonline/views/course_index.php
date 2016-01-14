 <div class="row">
    
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>List Course (Draft Status)</strong></h2>
            </div>
           
            <div class="panel-body">
            
            <?php if ($records): ?>
                <h3>Data Empty!</h3>
            <?php else: ?>
                <table class="table table-responsive ">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Materi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <?php foreach ($records as $course): ?>
                        <tr>
                            <th scope="row"><?php echo $course->code ?></th>
                            <td><?php echo $course->category->name ?></td>
                            <td><?php echo $course->name ?></td>
                            <td><?php echo $course->status_label ?></td>
                            <td><a href="<?php echo site_url('kelasonline/updateStatus/'.$course->id) ?>" class="btn btn-sm btn-update-custom">Publish</a></td>
                        </tr>                                    
                        <?php endforeach ?>

                    </tbody>
                </table>    
            <?php endif ?>
               
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#kelasonline').DataTable();
    } );
</script>