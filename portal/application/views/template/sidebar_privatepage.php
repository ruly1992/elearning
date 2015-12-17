<!-- start:content sidebar -->
<div class="content-sidebar">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-heading">
                    <h3>E-LIB DOWNLOAD</h3>
                </div>
                <div class="widget-heading-view">
                    <span class="pull-right"><a href="#">view all <i class="fa fa-plus-square"></i></a></span>
                </div>
                <div class="widget-content">
                    <div class="box-grey">
                        <ul>
                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Download file Penyempurnaan Social</a></li>
                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Download file Penyempurnaan Social</a></li>
                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Download file Penyempurnaan Social</a></li>
                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Download file Penyempurnaan Social</a></li>
                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Download file Penyempurnaan Social</a></li>
                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Download file Penyempurnaan Social</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-heading">
                    <h3>LINK INFORMASI DESA</h3>
                </div>
                <div class="widget-heading-view">
                    <span class="pull-right"><a href="#">view all <i class="fa fa-plus-square"></i></a></span>
                </div>
                <div class="widget-content">
                    <div class="box-grey">
                        <ul>
                            <?php foreach ($links as $link): ?>
                            
                            <li><a href="<?php echo $link->url ?>"><i class="fa fa-angle-double-right"></i> <?php echo $link->name ?></a></li>
                            
                            <?php endforeach ?>  
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
