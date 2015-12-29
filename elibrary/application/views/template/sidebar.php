                    <div class="content-widget">
                       <div class="widget">
                            <div class="widget-categories">
                                <div class="widget-categories-heading">
                                    <h4>Categories</h4>
                                </div>
                                <div class="widget-categories-content">
                                    <div class="list-group">
                                        <?php $medialib = new Library\Media\Media; ?>
                                        <?php foreach ($medialib->getCategories() as $category): ?>
                                            <a href="<?php echo $category->link ?>" class="list-group-item"><?php echo $category->name ?></a>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>