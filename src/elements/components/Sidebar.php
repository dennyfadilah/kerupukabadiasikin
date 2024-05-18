<?php
require 'config/config.php';
global $dir;

?>


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $dir; ?>">
        <div class="sidebar-brand-icon">
            <img src="src/assets/image/logo.png" alt="logo" width="50">
        </div>
        <div class="sidebar-brand-text mx-3">Abadi Asikin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($url == '/') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= $dir; ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Persediaan -->
    <?php $dataPersediaan = ['/persediaan-kerupuk-mentah', '/persediaan-kerupuk-matang']; ?>

    <li class="nav-item">
        <a class="nav-link <?= in_array($url, $dataPersediaan) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapsePersediaan" aria-expanded="true" aria-controls="collapsePersediaan">
            <i class="fas fa-fw fa-warehouse"></i>
            <span>Persediaan</span>
        </a>

        <div id="collapsePersediaan" class="collapse <?= in_array($url, $dataPersediaan) ? 'show' : ''; ?>" aria-labelledby="headingPersediaan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <!-- Persediaan Kerupuk Mentah -->
                <a class="collapse-item <?= ($url == '/persediaan-kerupuk-mentah') ? 'active' : ''; ?>" href="persediaan-kerupuk-mentah">Kerupuk Mentah</a>
                <!-- End Persediaan kerupuk Mentah -->

                <!-- Persediaan kerupuk Matang -->
                <a class="collapse-item <?= ($url == '/persediaan-kerupuk-matang') ? 'active' : ''; ?>" href="persediaan-kerupuk-matang">Kerupuk Matang</a>
                <!-- End Persediaan Kerupuk Matang -->
            </div>
        </div>
    </li>

    <!-- Nav Item - Penjualan -->
    <li class="nav-item <?= ($url == '/penjualan') ? 'active' : ''; ?>">
        <a class="nav-link" href="penjualan">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Penjualan</span></a>
    </li>

    <!-- Nav Item - Biaya Operasional -->
    <li class="nav-item <?= ($url == '/biaya-operasional') ? 'active' : ''; ?>">
        <a class="nav-link" href="biaya-operasional">
            <i class="fas fa-fw fa-hand-holding-usd"></i>
            <span>Biaya Operasional</span></a>
    </li>

    <!-- Nav Item - Laporan -->
    <?php $dataLaporan = ['/laporan-penjualan', '/laporan-persediaan', '/laporan-laba-rugi']; ?>
    <li class="nav-item">
        <a class="nav-link <?= in_array($url, $dataLaporan) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Laporan</span>
        </a>

        <div id="collapseLaporan" class="collapse <?= in_array($url, $dataLaporan) ? 'show' : ''; ?>" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= ($url == '/laporan-penjualan') ? 'active' : ''; ?>" href="laporan-penjualan">Lap. Penjualan</a>

                <a class="collapse-item <?= ($url == '/laporan-persediaan') ? 'active' : ''; ?>" href="laporan-persediaan">Lap. Persediaan</a>

                <a class="collapse-item <?= ($url == '/laporan-laba-rugi') ? 'active' : ''; ?>" href="laporan-laba-rugi">Lap. Laba Rugi</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Data Pekerja -->
    <li class="nav-item  <?= ($url == '/data-pekerja') ? 'active' : ''; ?>">
        <a class="nav-link" href="data-pekerja">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pekerja</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>