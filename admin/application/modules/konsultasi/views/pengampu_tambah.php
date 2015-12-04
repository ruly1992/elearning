<?php
$user_id=$this->uri->segment(3);
echo form_open('konsultasi/pengampu_tambah/' . $user_id); ?>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Nama Kategori Konsultasi</label>
                    <input type="hidden" name="data[user_id]" value="<?php echo $user_id; ?>" class="form-control">
                    <select name="data[id_kategori]" class="form-control">
                    <?php 
                        $row=$this->db->get('konsultasi_kategori')->result();
                        foreach ($row as $r) {
                      ?>
                            <option value="<?php echo $r->id;?>"><?php echo $r->name;?></option>
                     <?php } ?>
                     </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-save"></i> Tambah</button>
                </div>
            </div>
        </div>

</div>

<?php echo form_close(); ?>