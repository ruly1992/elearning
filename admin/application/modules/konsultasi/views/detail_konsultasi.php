<div class="row">
    <div class="col-md-12">  
    	<div class="panel panel-default">
    		<div class="panel-heading">
    			<div>
				    <ul class="breadcrumb">
				        <li><a href="<?php echo site_url() ?>">Home</a></li>
				        <li><a href="<?php echo site_url('/konsultasi') ?>">Konsultasi</a></li>
				        <li class="active">Detail Konsultasi</li>
				    </ul>
				</div>
    		</div>   
    	</div>  	
		<div class="panel panel-default">  
		  	<div class="panel-heading">
				<div class="pull-right text-right">
					<i class="fa fa-calendar"></i><br/>Tanggal Buat : <?php echo $konsultasi->created_at ?>
				</div>
				<div>
					<strong><?php echo $konsultasi->subjek ?> </strong>
				</div>
				<div>
					Pembuat : <?php foreach($user_id as $user){ echo $user->first_name.' '.$user->last_name; }?>
				</div>
				<div>
					
				</div>
		  	</div>
		  	<div class="panel-body">
		    	<?php echo $konsultasi->pesan ?>
		  	</div>
		  	<div class="panel-body">
				Lampiran : <strong><a href="<?php echo home_url('konsultasi/uploads/'.$konsultasi->attachment) ?>"><?php echo $konsultasi->attachment ?></a></strong>		  		
		  	</div>
		</div>
    </div>
</div>
