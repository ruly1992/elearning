<div class="elib-sidebar">
    <div class="elib-sidebar-heading">
        <h3>Kategori:</h3>
    </div>
    <ul class="nav nav-pills nav-stacked">
        <?php $medialib = new Library\Media\Media; ?>
        <?php foreach ($medialib->getCategories() as $category): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $category->link ?>"><?php echo $category->name ?></a>
        </li>
        <?php endforeach ?>
    </ul>
</div>