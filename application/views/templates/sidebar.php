<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
        <div class="sidebar-brand-text mx-3">Matuda Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- query menu -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "  SELECT a.id, a.menu
                        FROM user_menu AS a JOIN user_access_menu AS b
                        ON a.id = b.menu_id
                    WHERE b.role_id = $role_id
                    ORDER BY b.menu_id ASC
        ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <!-- looping menu -->
    <?php foreach ($menu as $m) : ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>


        <!-- looping submenu -->

        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT *
                            FROM user_sub_menu 
                            WHERE menu_id = $menuId
                            AND is_active = 1
        ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <li class="nav-item <?= $title == $sm['title'] ? "active" : "" ?>">
                <a class="nav-link py-2" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
            </li>
        <?php endforeach ?>

        <hr class="sidebar-divider">

    <?php endforeach; ?>


    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->