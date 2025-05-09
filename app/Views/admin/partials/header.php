<header class="main-header navbar">
    <div class="col-search">
        <form class="searchform" action="<?= base_url('admin/products') ?>" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Buscar produtos..." />
                <button class="btn btn-light bg" type="submit"><i class="material-icons md-search"></i></button>
            </div>
        </form>
    </div>
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
            </li>
            <li class="nav-item">
                <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
            </li>
            <li class="dropdown nav-item">
                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> 
                    <img class="img-xs rounded-circle" src="<?= base_url('assets/admin/imgs/people/avatar-2.png') ?>" alt="User" />
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                    <a class="dropdown-item" href="<?= base_url('admin/profile') ?>"><i class="material-icons md-perm_identity"></i>Meu Perfil</a>
                    <a class="dropdown-item" href="<?= base_url('admin/settings') ?>"><i class="material-icons md-settings"></i>Configurações</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?= base_url('admin/logout') ?>"><i class="material-icons md-exit_to_app"></i>Sair</a>
                </div>
            </li>
        </ul>
    </div>
</header> 