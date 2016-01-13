<div class="row">
    <div class="col-md-12">  
	    <ul class="breadcrumb">
	        <li><a href="<?php echo site_url() ?>">Home</a></li>
	        <li><a href="<?php echo site_url('/konsultasi') ?>">Konsultasi</a></li>
	        <li class="active"><?php echo $konsultasi->subjek ?></li>
	    </ul>
		<div class="panel panel-info">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">
		    		<strong>
		    			<span class="fa fa-bookmark"></span> <?php echo $konsultasi->subjek ?> | 
		    			<span class="fa fa-user"> </span> <?php echo user($konsultasi->user_id)->full_name ?> |
		    			<span class="fa fa-calendar"> </span> <?php echo $konsultasi->created_at ?>
		    		</strong>
		    	</h3>
		  	</div>
		  	<div class="panel-body">
		    	<?php echo $konsultasi->pesan ?>
		    	<hr>
				Lampiran : <a href="<?php echo konsultasi_attachment($konsultasi->attachment) ?>"><?php echo $konsultasi->attachment ?></a>	  		
		  	</div>
		</div>
		<div class="panel panel-default">
		  	<div class="panel-heading">
		  		Balasan
		  	</div>
		  	<div class="panel-body">
		  		<?php if ($reply->count()): ?>
			  		<?php foreach ($reply as $data) { ?>
						<div class="media">
						  	<a class="pull-left" href="page-activity.html#">
						    	<img class="media-object img-rounded" src="<?php echo auth()->getUser($data->id_user)->avatar ?>" width="70" height="70">
						  	</a>
						  	<div class="media-body">
								<div class="pull-right small"><?php echo $data->created_at ?></div>
								<h4 class="media-heading"><?php echo user($data->id_user)->full_name ?></h4>
						    	<p><?php echo $data->isi ?></p>
						    	<div class="card-block">
	                                <p class="card-text">
	                                   <a href="<?php echo home_url('app/files/konsultasi-attachment/'.$data->attachment) ?>"><?php echo $data->attachment ?></a>
	                                </p>
	                            </div>
						  	</div>
						</div>
					<?php } ?> 	
					<center>
					  	<nav>
		                   	<ul>
		                        <?php echo $reply->render() ?>
		                    </ul>
		                </nav>
					</center>				
				<?php else: ?>                       
		            <p class="alert alert-warning">Tidak Ada Balasan</p>
		        <?php endif ?>
			</div>
    	</div>
    </div>
</div>
