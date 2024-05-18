<?php

require 'config/config.php';

if (isset($_POST['logout'])) {
    logout();
}

if (isset($_POST['showAllNotif'])) {
    if (readAll()) {
        echo '<script>window.location.replace("notifikasi");</script>';
    }
}

$nama = isset($_SESSION['nama_user']) ? $_SESSION['nama_user'] : 'NULL';
?>


<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <?php

                $query = mysqli_query($koneksi, "SELECT id_log, is_read FROM log_activity WHERE is_read = 0");
                $count = mysqli_num_rows($query);

                if ($count > 0) {
                    echo '<span class="badge badge-danger badge-counter">' . $count . '</span>';
                }
                ?>
            </a>
            <!-- Dropdown - Alerts -->
            <?php include 'Notifikasi.php' ?>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nama ?></span>
                <span class="text-lg"><i class="fa fa-user-circle"></i></span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="#" id="manageDropdown" role="button" aria-expanded="false">
                    <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                    Kelola
                </a>

                <div id="manageCollapse" class="collapse <?= ($_SESSION['url'] == '/akun' || $_SESSION['url'] == '/users') ? 'show' : ''; ?>">

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item <?= ($_SESSION['url'] == '/akun') ? 'active' : ''; ?>" href="<?= $dir; ?>/akun">
                        <i class="fas fa-warehouse fa-sm fa-fw mr-2 text-gray-400"></i>
                        Akun
                    </a>

                    <a class="dropdown-item <?= ($_SESSION['url'] == '/users') ? 'active' : ''; ?>" href="<?= $dir; ?>/users">
                        <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                        Users
                    </a>

                    <div class="dropdown-divider"></div>
                </div>

                <form method="post">
                    <button class="dropdown-item <?= ($_SESSION['url'] == '/notifikasi') ? 'active' : ''; ?>" type="submit" name="showAllNotif">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Notifikasi
                    </button>
                </form>

                <div class="dropdown-divider"></div>

                <form method="post">
                    <button class="dropdown-item" type="submit" onclick="return confirm('Apakah anda yakin ingin logout?')" name="logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>

    </ul>

</nav>

<script>
    document.getElementById('manageDropdown').addEventListener('click', function(event) {
        event.stopPropagation();
        document.getElementById('manageCollapse').classList.toggle('show');
    });
</script>