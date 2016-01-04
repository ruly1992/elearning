<?php if ($paginator->lastPage() > 1): ?>
<ul class="pagination pagination-sm">
    <li class="page-item <?php echo ($paginator->currentPage() == 1) ? ' disabled' : '' ?>">
        <a class="page-link" href="<?php echo $paginator->url(1) ?>">Previous</a>
    </li>
    <?php for ($i = 1; $i <= $paginator->lastPage(); $i++): ?>
        <li class="page-item <?php echo ($paginator->currentPage() == $i) ? ' active' : '' ?>">
            <a class="page-link" href="<?php echo $paginator->url($i) ?>"><?php echo $i ?></a>
        </li>
    <?php endfor ?>
    <li class="page-item <?php echo ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' ?>">
        <a class="page-link" href="<?php echo $paginator->url($paginator->currentPage()+1) ?>">Next</a>
    </li>
</ul>
<?php endif ?>