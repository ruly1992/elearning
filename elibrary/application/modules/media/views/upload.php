<div class="elib-content-single">
    <div class="elib-single-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="<?php echo $category->link ?>"><?php echo $category->name ?></a></li>
            <li class="active">Upload</li>
        </ol>
    </div>
    <div class="title">
        <h1>Upload</h1>
        <span><small>
            <ul>
            </ul>
        </small></span>
    </div>
    <div class="description-meta">
        <div id="fileuploader" data-url="<?php echo site_url('media/submit/' . $category->id) ?>" data-category-id="<?php echo $category->id ?>">Upload</div>
    
        <button class="btn btn-danger" id="extrabutton">Start</button>
    </div>
</div>
