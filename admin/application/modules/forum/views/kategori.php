<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Tambah Kategori</strong></h2>
            </div>
            <div class="panel-body"> 
            <?php 
                $row=$this->db->query('select * from forum_kategori
                                     ')->result();
            ?>
                <form method="post" action="<?php echo site_url().'/forum/kategori_tambah'?>">
                    
                    <input type="text" name="data[kategori]" class="form-control"><br>

                    <input type="submit" class="btn-primary" value="Simpan">
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Daftar Kategori Forum</strong></h2>
            </div>
            <div class="panel-body"> 
            <?php 
                $row=$this->db->query('select * from forum_kategori
                                     ')->result();
            ?>
                <table class="table table-hover table-bordered" id="article">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategori</th>
                            <th></th>                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;foreach ($row as $r): ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $r->kategori;?></td>
                            <td>
                                <?php echo button_edit('/forum/kategori_edit/' . $r->id) ?>
                                <?php echo button_delete('/forum/kategori_hapus/' . $r->id) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#article').DataTable(
            {"ordering": false}
        );
    } );
</script>
