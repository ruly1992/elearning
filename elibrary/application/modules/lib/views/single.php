<div class="elib-content-single">
    <div class="elib-single-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="<?php echo $category->link ?>"><?php echo $category->name ?></a></li>
            <li class="active"><?php echo $media->name ?></li>
        </ol>
    </div>
    <div class="title">
        <h1><?php echo $media->name ?></h1>
        <span><small>
            <ul>
                <li><i class="fa fa-calendar"></i> <?php echo $media->created_at->format('d/m/Y') ?></li>
                <li><i class="fa fa-user"></i> <?php echo $media->user->full_name ?></li>
            </ul>
        </small></span>
    </div>
    <div class="description-meta">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="description-meta-left">
                    <div class="text-center">
                        <div class="preview-media" style="width: 200px; height: 200px;">
                            <?php echo $media->getPreview(200, 200) ?>
                        </div>
                        <br>
                        <span><?php echo $media->icon ?> <?php echo $media->type ?></span>
                    </div>
                    <div class="description-meta-button">
                        <a href="<?php echo $media->getLinkDownload() ?>" class="btn btn-sm btn-block btn-download"><i class="fa fa-download"></i> Download</a>
                        <a href="<?php echo $media->getLinkPreview() ?>" class="btn btn-sm btn-block btn-preview"><i class="fa fa-eye"></i> Preview</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="description-meta-right">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="thead-inverse">
                            <tr>
                                <th>#</th>
                                <th>Meta Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Judul</td>
                                <td><?php echo $media->title ?></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Description</td>
                                <td><?php echo $media->description ?></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>File Size</td>
                                <td><?php echo $media->file_size_format ?></td>
                            </tr>
                            <?php $i = 4; foreach ($media->getMetadata() as $key => $value): ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $key ?></td>
                                    <td><?php echo $value ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="description-full">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="description-full-title">
                    <p><strong>Full Description :</strong></p>
                </div>
                <p><?php echo $media->getMetadata('full_description') ?></p>                
            </div>
        </div>
    </div>
</div>