<!-- start: Main Menu -->
<div class="sidebar">

    <div class="sidebar-collapse">

        <div class="sidebar-header">

            <img src="<?php echo auth()->getUser()->avatar ?>">

            <h2><?php echo auth()->getUser()->full_name ?></h2>
            <h3><?php echo auth()->getUser()->email ?></h3>

        </div>

        <div class="sidebar-menu">
            <?php echo $navigator ?>
        </div>                  
    </div>
    <div class="sidebar-footer">
        
    </div>  
</div>
<!-- end: Main Menu -->