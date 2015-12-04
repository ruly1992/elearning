<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><strong>Daftar Konsultasi</strong></h2>
            </div>
            <div class="panel-body"> 
            <?php 
                $row=$this->db->query('select a.id,a.email,d.first_name,d.last_name
                                        from users a,users_groups b,groups c,profile d
                                         where a.id=b.user_id and b.group_id=c.id and d.user_id=a.id
                                         and c.id=10
                                     ')->result();
            ?>

                <table class="table table-hover table-bordered" id="article">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama lengkap</th>
                            <th>email</th>
                            <th>Kategori</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;foreach ($row as $r): ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $r->first_name.' '.$r->last_name;?> </td>
                            <td><?php echo $r->email;?></td>
                            <td>
                            <?php 
                                $data=$this->db->query('select b.id,a.name 
                                                        from konsultasi_kategori a,user_kategori b
                                                        where a.id=b.id_kategori and 
                                                        b.user_id='.$r->id.''
                                                        )->result();
                                foreach($data as $d){ ?>

                            <?php echo $d->name;?> <a href="<?php echo site_url().'/konsultasi/pengampu_kategori_hapus/'.$d->id;?>"><i class="fa fa-trash-o"></i></a>
                              <br>
                              <?php  } ?>
                            </td>
                            <td>
                                <a href="<?php echo site_url('konsultasi/pengampu_tambah/') ?>" ></a>
                                <a href="<?php echo site_url('konsultasi/pengampu_tambah/').'/'. $r->id ?>" class="btn btn-success">Tambah Kategori</a>
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
