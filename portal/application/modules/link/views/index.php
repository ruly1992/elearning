<!-- start:section content main articles -->
<section class="content-articles">
    <div class="content-articles-heading">
        <h3>Link Informasi Desa</h3>
    </div>
    <div class="content-articles-main">
        <div class="row">
            <?php foreach ($linkAll->chunk(10) as $chunk): ?>                
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="articles-box">
                    <div class="articles-box-title">
                         <ul style="list-style: none;">
                           	<?php foreach ($chunk as $link): ?>
					            <li style="margin-bottom: 5px; border-bottom: 1px dotted #ddd; padding: 0 10px 5px 10px; ">
                                    <h5 style="margin-bottom: 0; margin-top: 0">
                                        <a href="<?php echo $link->url ?>" target="_blank" style="text-decoration: none;"><?php echo $link->name ?></a>
                                    </h5>
                                    <p style="margin-bottom: 0;"><small><?php echo $link->description ?></small></p>
                                </li>
					            
					        <?php endforeach ?>  
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            <div class="col-md-12">
                <?php echo $linkAll->render() ?>
            </div>
        </div>
    </div>
</section>
<!-- end:section content main articles -->