<div class="row">
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
        <div class="content-elib-main-search top">
            <div class="text-center">
                <form action="<?php echo site_url('search') ?>" method="GET" class="form-inline">
                    <div class="form-group">
                        <input name="q" type="text" value="<?php echo isset($term) ? $term : '' ?>" class="form-control" placeholder="Search type in here..">
                    </div>
                    <div class="form-group">
                        <?php
                        $medialib   = new Library\Media\Media;
                        $categories = $medialib->getCategories()
                        ->pluck('name', 'id')
                        ->prepend('Select with category')
                        ->toArray();
                        ?>
                        <?php echo form_dropdown('category', $categories, 0, ['class' => 'c-select']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_dropdown('meta', [
                            'Select with Meta',
                            'Name Library',
                            'Author',
                            'Tahun Terbit',
                            'Images',
                            'Video',
                            'Music',
                        ], 0, [
                            'class' => 'c-select'
                        ]); ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-search">SEARCH</a>
                    </div>
                </form>
            </div>
            <div class="text-center">
                <p>Silahkan cari content library yang anda inginkan.</p>
            </div>
        </div>
    </div>
</div>