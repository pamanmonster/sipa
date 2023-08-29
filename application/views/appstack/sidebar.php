<?php
    // print_r($menus);exit;
    $route = $this->router->fetch_class() . '/' . $this->router->fetch_method();
?>
<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?= base_url('admin') ?>">
            <img src="<?= base_url('assets/img/logo.png"') ?> width="150">
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Administrator
            </li>
            <?php foreach($menus as $key => $menu): ?>
                <li class="sidebar-item <?php if($route === $menu->router) echo 'active'; ?>">
                    <?php if($menu->isfolder == 1) { ?>                    
                        <a data-bs-target="#<?= $menu->menu_id?>" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="<?= $menu->icon ?>"></i> <span class="align-middle"><?= $menu->name ?></span>
                        </a>
                        <ul id="<?= $menu->menu_id?>" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                            <?php foreach($menu->children as $k => $sub): ?>
                                <li class="sidebar-item <?php if($route === $sub->router) echo 'active'; ?>"><a class="sidebar-link" href="<?= base_url($sub->url) ?>"><?= $sub->name?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php } else { ?>
                        <a class="sidebar-link" href="<?= base_url($menu->url) ?>">
                            <i class="align-middle" data-feather="<?= $menu->icon ?>"></i> <span class="align-middle"><?= $menu->name ?></span>
                        </a>                    
                    <?php } ?>                    
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>