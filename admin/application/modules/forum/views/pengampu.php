<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2><strong>Cari Moderator</strong></h2>
                <div class="form-group">
                    <form method="post" action="">     
                        <table class="table table-condensed">                  
                        <tr>
                            <td>
                                <input type="text" placeholder="Nama Moderator" class="form-control" name="nama" id="nama">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success" value="cari"><i class="fa fa-search"></i></button>
                            </td>                                       
                        </tr>
                        </table>
                    </form>

                    <label>Nama Lengkap</label>
                    <div id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <?php
                                $nama=$this->input->post('nama');
                                if(!empty($nama)){  
                                    $row=$this->db->query("select * from profile where first_name like '%$nama%'  or last_name like '%$nama%'   " )->result();
                                    foreach($row as $r){
                            ?>
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a href="<?php echo $r->user_id; ?>#<?php echo $r->user_id ?>" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" aria-expanded="true">
                                 <?php echo $r->first_name.' '.$r->last_name ?>
                                </a>
                              </h4>
                            </div>
                            <div class="panel-collapse collapse in" id="<?php echo $r->user_id ?>" aria-expanded="true" style="">
                                <div class="panel-body">
                                    <form method="post" action="<?php echo site_url().'/forum/pilih_user_save'?>">

                                        <?php $user_id=$this->uri->segment(3);?>
                                        
                                        <input type="hidden" name="data[user_id]" value="<?php echo $r->user_id ?>">
                                        
                                        <select name="data[id_kategori]" size="1" class="form-control">
                                            <?php
                                                $row=$this->db->get('forum_kategori')->result();
                                                foreach($row as $r){
                                            ?>
                                                <option value="<?php echo $r->id;?>"><?php echo $r->kategori;?></option>
                                            <?php } ?>
                                        </select>

                                        <input type="submit" value="Simpan">

                                    </form>
                                </div>
                            </div>
                            <?php }} ?>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body"> 
            <?php 
                $row=$this->db->query('select a.id,a.email,d.first_name,d.last_name
                                        from users a,users_groups b,groups c,profile d,forum_kategori_user e
                                         where a.id=b.user_id and b.group_id=c.id and d.user_id=a.id and
                                         e.user_id=a.id group by a.id
                                     ')->result();
            ?>
                <h2><strong>Daftar Moderator</strong></h2>

                <hr>
                <table class="table table-hover table-bordered" id="article">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama lengkap</th>
                            <th>email</th>
                            <th>Kategori</th>
                           
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
                                $data=$this->db->query('select b.id,a.kategori 
                                                        from forum_kategori a,forum_kategori_user b
                                                        where a.id=b.id_kategori and 
                                                        b.user_id='.$r->id.''
                                                        )->result();
                                foreach($data as $d){ ?>

                            <?php echo $d->kategori;?> <a href="<?php echo site_url().'/forum/pengampu_kategori_hapus/'.$d->id;?>"><i class="fa fa-trash-o"></i></a>
                              <br>
                              <?php  } ?>
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
