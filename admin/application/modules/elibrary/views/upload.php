<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Upload Category: <?php echo $category->name ?></h3>
    </div>
    <div class="panel-body">
        <div id="fileuploader" data-url="<?php echo site_url('media/submit/' . $category->id) ?>" data-category-id="<?php echo $category->id ?>">Upload</div>
    
        <button class="btn btn-danger" id="extrabutton">Start</button>
    </div>
</div>
