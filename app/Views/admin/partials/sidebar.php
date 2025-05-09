<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="<?= base_url('admin') ?>" class="brand-wrap">
            <img src="<?= base_url('assets/admin/imgs/theme/logo.svg') ?>" class="logo" alt="Mercado Dashboard" />
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item <?= current_url() == base_url('admin') ? 'active' : '' ?>">
                <a class="menu-link" href="<?= base_url('admin') ?>">
                    <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="menu-item has-submenu <?= strpos(current_url(), 'admin/products') !== false ? 'active' : '' ?>">
                <a class="menu-link" href="<?= base_url('admin/products') ?>">
                    <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Produtos</span>
                </a>
                <div class="submenu">
                    <a href="<?= base_url('admin/products') ?>">Listar Produtos</a>
                    <a href="<?= base_url('admin/products/create') ?>">Adicionar Produto</a>
                </div>
            </li>
            <li class="menu-item <?= current_url() == base_url('admin/categories') ? 'active' : '' ?>">
                <a class="menu-link" href="<?= base_url('admin/categories') ?>">
                    <i class="icon material-icons md-category"></i>
                    <span class="text">Categorias</span>
                </a>
            </li>
            <li class="menu-item has-submenu <?= strpos(current_url(), 'admin/settings') !== false || strpos(current_url(), 'admin/profile') !== false ? 'active' : '' ?>">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-settings"></i>
                    <span class="text">Configurações</span>
                </a>
                <div class="submenu">
                    <a href="<?= base_url('admin/settings') ?>" class="<?= current_url() == base_url('admin/settings') ? 'active' : '' ?>">Configurações da Loja</a>
                    <a href="<?= base_url('admin/profile') ?>" class="<?= current_url() == base_url('admin/profile') ? 'active' : '' ?>">Meu Perfil</a>
                </div>
            </li>
        </ul>
        <hr />
        <ul class="menu-aside">
            <li class="menu-item">
                <a class="menu-link" href="<?= base_url('admin/logout') ?>">
                    <i class="icon material-icons md-exit_to_app"></i>
                    <span class="text">Sair</span>
                </a>
            </li>
        </ul>
        <br />
        <br />
    </nav>
</aside> 