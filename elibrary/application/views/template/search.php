<div class="row">
    <div class="col-lg-8 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
        <div class="content-elib-main-search top">
            <div class="text-center">
                <form action="<?php echo site_url('search') ?>" method="GET" class="form-inline">
                    <div class="form-group">
                        <input name="q" type="text" value="<?php echo isset($term) ? $term : '' ?>" class="form-control" required placeholder="Cari judul ...">
                    </div>
                    <div class="form-group">
                        <?php
                        $medialib   = new Library\Media\Media;
                        $categories = $medialib->getCategories()
                        ->pluck('name', 'id')
                        ->prepend('Select with category', '')
                        ->toArray();
                        ?>
                        <?php echo form_dropdown('category', $categories, 0, ['class' => 'c-select', 'required' => 'required']); ?>
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