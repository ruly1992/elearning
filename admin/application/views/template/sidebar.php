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
                        <h2><?php echo auth()->getUser()->full_name ?></h2>
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