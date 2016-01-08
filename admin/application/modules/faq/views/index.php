<div class="panel panel-default">
    <div class="panel-body">
        <?php echo button_create('faq/create', 'Tambah FAQ')?>
        <hr>

        <table class="table table-hover table-bordered" id="faq">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                foreach ($list_faq as $row):
                   
                 ?>
                <tr>
                    <td><?php echo $row->title ?></td>
                    <td><?php echo $row->question ?></td>
                    <td><?php echo $row->answer ?></td>
                    <td>
                        <?php echo button_edit('faq/update/' . $row->id) ?>
                        <?php echo button_delete('faq/delete/' . $row->id) ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#faq').DataTable();
    } );
</script>
