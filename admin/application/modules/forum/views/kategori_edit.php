<?php $id=$this->uri->segment(3);
	$kategori="";
	$data=$this->db->get_where('forum_kategori',array('id'=>$id))->result();
	foreach ($data as $d ) {$kategori=$d->kategori;
		
	}
?>
<form method="post" action="<?php echo site_url().'/forum/kategori_edit'?>">
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
			<input type="hidden" value="<?php echo $id;?>" name="id">

            <div class="panel-body">
                <div class="form-group">
                    <label>Kategori Forum</label>
                    <input type="text" name="data[kategori]" value="<?php echo $kategori; ?>" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
