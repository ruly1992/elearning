<!-- start: Header -->
<div class="navbar" role="navigation">
	<div class="navbar-header">
		<a class="navbar-brand" href="<?php echo site_url() ?>"><i class="icon-users"></i> <span>Portal</span></a>
	</div>
	<ul class="nav navbar-nav navbar-actions navbar-left">
		<li class="visible-md visible-lg"><a href="#" id="main-menu-toggle"><i class="fa fa-bars"></i></a></li>
		<li class="visible-xs visible-sm"><a href="#" id="sidebar-menu"><i class="fa fa-bars"></i></a></li>
	</ul>
	<form action="" class="navbar-form navbar-left">
		<i class="fa fa-search"></i>
		<input type="text" class="form-control" placeholder="Are you looking for something ?">
	</form>
    <ul class="nav navbar-nav navbar-right visible-md visible-lg">
    	<li>
    		<button data-href="<?php echo home_url() ?>" target="_blank" class="btn btn-success btn-visit-home"><i class="fa fa-external-link"></i> Visit Website</button>
    	</li>
		<li class="dropdown visible-md visible-lg">
    		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-settings"></i></a>
    		<ul class="dropdown-menu">
				<li class="dropdown-menu-header text-center">					
					<strong>Settings</strong>
				</li>
				<li><a href="<?php echo site_url('profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
				<li><a href="<?php echo site_url('user/logout') ?>"><i class="fa fa-lock"></i> Logout</a></li>	
    		</ul>
  		</li>
	</ul>
</div>
<!-- end: Header -->