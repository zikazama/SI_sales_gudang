<div class="page-sidebar">
    <div class="logo-box"><a href="<?= base_url() ?>" class="logo-text">SISAGU</a><a href="#" id="sidebar-close"><i class="material-icons">close</i></a> <a href="#" id="sidebar-state"><i class="material-icons">adjust</i><i class="material-icons compact-sidebar-icon">panorama_fish_eye</i></a></div>
    <div class="page-sidebar-inner slimscroll">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Apps
            </li>
            <?php if ($this->session->userdata('role') == 'sales') { ?>
                <li class="<?= $this->uri->segment(1) == 'home' ? 'active-page' : '' ?>">
                    <a href="<?= base_url('home') ?>" class="active"><i class="material-icons-outlined">dashboard</i>Dashboard</a>
                </li>
                <li class="<?= $this->uri->segment(1) == 'penjualanku' ? 'active-page' : '' ?>">
                    <a href="<?= base_url('penjualanku') ?>" class="active"><i class="material-icons">bar_chart</i>Penjualanku</a>
                </li>
                <li class="<?= $this->uri->segment(1) == 'lokasi' ? 'active-page' : '' ?>">
                    <a href="<?= base_url('lokasi') ?>" class="active"><i class="material-icons">location_on</i>Atur Lokasi Toko</a>
                </li>
            <?php } else if ($this->session->userdata('role') == 'driver') { ?>
                <li class="<?= $this->uri->segment(1) == 'home' ? 'active-page' : '' ?>">
                    <a href="<?= base_url('home') ?>" class="active"><i class="material-icons-outlined">dashboard</i>Dashboard</a>
                </li>
                <li class="<?= $this->uri->segment(1) == 'rkab' ? 'active-page' : '' ?>">
                    <a href="<?= base_url('rkab') ?>" class="active"><i class="material-icons-outlined">bar_chart</i>RKAB</a>
                </li>
            <?php } else if ($this->session->userdata('role') == 'admin') { ?>
                <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'home'  ? 'active-page' : '' ?>">
                    <a href="<?= base_url('admin/home') ?>" class="active"><i class="material-icons-outlined">dashboard</i>Admin Dashboard</a>
                </li>
                <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'kelola_barang'  ? 'active-page' : '' ?>">
                    <a href="<?= base_url('admin/kelola_barang') ?>" class="active"><i class="material-icons">input</i>Kelola Barang</a>
                </li>
                <!-- <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'kelola_toko'  ? 'active-page' : '' ?>">
                    <a href="<?= base_url('admin/kelola_toko') ?>" class="active"><i class="material-icons">shop</i>Kelola Toko</a>
                </li> -->
                <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'kelola_akses'  ? 'active-page' : '' ?>">
                    <a href="<?= base_url('admin/kelola_akses') ?>" class="active"><i class="material-icons">next_week</i>Kelola Akses</a>
                </li>
                <li>
                    <a href="#"><i class="material-icons">apps</i>Kelola Karyawan<i class="material-icons has-sub-menu">add</i></a>
                    <ul class="sub-menu">
                        <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'kelola_sales'  ? 'active-page' : '' ?>">
                            <a href="<?= base_url('admin/kelola_sales') ?>" class="active"><i class="material-icons-outlined">account_circle</i>Kelola Sales</a>
                        </li>
                        <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'kelola_driver'  ? 'active-page' : '' ?>">
                            <a href="<?= base_url('admin/kelola_driver') ?>" class="active"><i class="material-icons-outlined">account_circle</i>Kelola Driver</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="material-icons">apps</i>Laporan & RKAB<i class="material-icons has-sub-menu">add</i></a>
                    <ul class="sub-menu">
                        <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'laporan_penjualan' && ($this->uri->segment(3) == null || $this->uri->segment(3) == 'toko')  ? 'active-page' : '' ?>">
                            <a href="<?= base_url('admin/laporan_penjualan') ?>" class="active"><i class="material-icons">bar_chart</i>Laporan Pertoko</a>
                        </li>
                        <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'laporan_penjualan' && $this->uri->segment(3) == 'pertransaksi'  ? 'active-page' : '' ?>">
                            <a href="<?= base_url('admin/laporan_penjualan/pertransaksi') ?>" class="active"><i class="material-icons">bar_chart</i>Laporan Penjualan</a>
                        </li>
                        <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'laporan_penjualan' && $this->uri->segment(3) == 'pertanggal'  ? 'active-page' : '' ?>">
                            <a href="<?= base_url('admin/laporan_penjualan/pertanggal') ?>" class="active"><i class="material-icons">bar_chart</i>Laporan Pertanggal</a>
                        </li>
                        <li class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rkab'  ? 'active-page' : '' ?>">
                            <a href="<?= base_url('admin/rkab') ?>" class="active"><i class="material-icons">bar_chart</i>RKAB</a>
                        </li>

                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>