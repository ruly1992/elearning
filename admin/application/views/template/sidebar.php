<!-- start: Main Menu -->
<div class="sidebar">

    <div class="sidebar-collapse">
        <center>
            <div class="sidebar-header">
                <div class="admin-image">
                        <img src="<?php echo auth()->getUser()->avatar ?>">
                </div>
                <div class="admin-info">
                    <center>
                        <h2><?php echo auth()->getUser()->full_name ?> 
                            <a href="#" aria-expanded="false" type="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo site_url('profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo logout_url() ?>"><i class="fa fa-lock"></i> Logout</a></li>
                            </ul>
                        </h2>

                        <h3><?php echo auth()->getUser()->email ?></h3>
                    </center>
                </div>
            </div>
        </center>

        <div class="sidebar-menu">
            <?php echo $navigator ?>
        </div>                  
    </div>
    <div class="sidebar-footer">

    </div>  
</div>
<!-- end: Main Menu -->