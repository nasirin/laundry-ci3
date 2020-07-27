<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url() ?>" class="brand-link">
    <img src="<?= base_url('assets/img/') ?>laundryLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light">Ship Laundry</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= $this->fungsi->user_login()->photo_karyawan ? base_url('assets/img/karyawan/') . $this->fungsi->user_login()->photo_karyawan : base_url('assets/img/karyawan/default.png') ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?= site_url('profil') ?>" class="d-block"><?= $this->fungsi->user_login()->nama_karyawan ?></a>
        <small>
          <span class="d-block text-gray"><?= $this->fungsi->user_login()->nama_level ?></span>
        </small>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        <?php if ($this->session->userdata('level') == 1) { ?>
          <li class="nav-item">
            <a href="<?= base_url() ?>" class="nav-link <?= $this->uri->segment(1) == '' | $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'order_kiloan' | $this->uri->segment(2) == 'order_satuan' ? 'menu-open' : '' ?>">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-shopping-basket"></i>
            <p>Pesanan</p>
            <i class="float-right right fas fa-angle-left"></i>
            <span class="float-sm-right">
              <span class="badge badge-info">New</span>
              <span class="badge badge-success">Done</span>
              <span class="badge badge-danger">Expired</span>
            </span>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('order/order_kiloan') ?>" class="nav-link <?= $this->uri->segment(2) == 'order_kiloan' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Kiloan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('order/order_satuan') ?>" class="nav-link <?= $this->uri->segment(2) == 'order_satuan' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Satuan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('member') ?>" class="nav-link <?= $this->uri->segment(1) == 'member' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-address-card"></i>
            <p>Member</p>
            <span class="float-sm-right">
              <span class="badge badge-info">New</span>
            </span>
          </a>
        </li>
        <!-- jasa -->
        <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'product_kiloan' | $this->uri->segment(2) == 'product_satuan' ? 'menu-open' : '' ?>">
          <a href="" class="nav-link">
            <i class="nav-icon fab fa-product-hunt"></i>
            <p> Jasa</p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav-item nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('product/product_kiloan') ?>" class="nav-link <?= $this->uri->segment(2) == 'product_kiloan' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Kiloan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('product/product_satuan') ?>" class="nav-link <?= $this->uri->segment(2) == 'product_satuan' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Satuan</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="<?= site_url('promo') ?>" class="nav-link <?= $this->uri->segment(1) == 'promo' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tag"></i>
            <p>Promo</p>
          </a>
        </li>

        <?php if ($this->session->userdata('level') == 1) { ?>
          <li class="nav-item">
            <a href="<?= site_url('inventory') ?>" class="nav-link <?= $this->uri->segment(1) == 'inventory' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Bahan baku</p>
              <span class="float-sm-right">
                <span class="badge badge-info">New</span>
                <span class="badge badge-warning">Update</span>
                <span class="badge badge-danger">empty</span>
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('employee') ?>" class="nav-link <?= $this->uri->segment(1) == 'employee' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Karyawan</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?= site_url('report') ?>" class="nav-link <?= $this->uri->segment(1) == 'report' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p> Laporan </p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('order/order_kiloan') ?>" class="nav-link <?= $this->uri->segment(2) == 'order_kiloan' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('order/order_satuan') ?>" class="nav-link <?= $this->uri->segment(2) == 'order_satuan' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Bahan Baku</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('test') ?>" class="nav-link <?= $this->uri->segment(1) == 'test' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-cube"></i>
              <p> Test </p>
            </a>
          </li>
        <?php } ?>

        <li class="nav-item">
          <a href="<?= site_url('auth/logout') ?>" class="nav-link tombol-keluar">
            <i class="nav-icon fa fa-sign-out-alt"></i>
            <p> Kaluar </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>