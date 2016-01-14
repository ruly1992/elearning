<ul class="nav nav-sidebar">
    <?php foreach ($menus as $menu): ?>
        <?php if (array_key_exists('child', $menu)): ?>
            <li>
                <a href="#"><i class="<?php echo $menu['icon'] ?>"></i><span class="text"><?php echo $menu['name'] ?></span> <span class="indicator"></span></a></a>
                <ul>
                    <?php foreach ($menu['child'] as $child): ?>
                        <li><a href="<?php echo $child['link'] ?>"><i class="<?php echo $child['icon'] ?>"></i><span class="text"><?php echo $child['name'] ?></span></a></li>
                    <?php endforeach ?>
                </ul>
            </li>
        <?php else: ?>
            <li><a href="<?php echo $menu['link'] ?>"><i class="<?php echo $menu['icon'] ?>"></i><span class="text"><?php echo $menu['name'] ?></span></a></li>
        <?php endif ?>
    <?php endforeach ?>
</ul>