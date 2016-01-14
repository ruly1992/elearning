<?php if ($paginator->lastPage() > 1): ?>
<ul class="pagination">
    <li class="<?php echo ($paginator->currentPage() == 1) ? ' disabled' : '' ?>">
        <a href="<?php echo $paginator->url(1) ?>">Previous</a>
    </li>
    <?php for ($i = 1; $i <= $paginator->lastPage(); $i++): ?>
        <li class="<?php echo ($paginator->currentPage() == $i) ? ' active' : '' ?>">
            <a href="<?php echo $paginator->url($i) ?>"><?php echo $i ?></a>
        </li>
    <?php endfor ?>
    <li class="<?php echo ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' ?>">
        <a href="<?php echo $paginator->url($paginator->currentPage()+1) ?>">Next</a>
    </li>
</ul>
<?php endif ?>