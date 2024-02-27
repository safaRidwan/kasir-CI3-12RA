<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/R.jpeg" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><?= $this->session->userdata('nama'); ?></a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <?php $menu = $this->uri->segment(1); ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class -->
            <li class="nav-item <?php if($menu=='home'){ echo "active"; } ?>">
                <a href="<?= base_url('home') ?>" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Home
                    </p>
                </a>
            </li>
            <li class="nav-item <?php if($menu=='penjualan'){ echo "active"; } ?>">
                <a href="<?= base_url('penjualan') ?>" class="nav-link">
                    <i class="nav-icon fas fa-cart-plus"></i>
                    <p>
                        Penjualan
                    </p>
                </a>
            </li>
            <li class="nav-item <?php if($menu=='pelanggan'){ echo "active"; } ?>">
                <a href="<?= base_url('pelanggan') ?>" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Pelanggan
                    </p>
                </a>
            </li>
            <li class="nav-item <?php if($menu=='produk'){ echo "active"; } ?>">
                <a href="<?= base_url('produk') ?>" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>
                        Produk
                    </p>
                </a>
            </li>

            <?php if($this->session->userdata('level')=='admin') { ?>
                <li class="nav-item <?php if($menu=='user'){ echo "active"; } ?>">
                    <a href="<?= base_url('user') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
            <?php } ?>

            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>