<?php

if (isset($_POST['readAll'])) {
    if (readAll()) {
        echo '<script>window.location.href = window.location.href</script>';
    }
}

if (isset($_POST['showAllNotif'])) {
    if (readAll()) {
        echo '<script>window.location.replace("?page=notifikasi");</script>';
    }
}

?>

<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
    <h6 class="dropdown-header">
        Notifikasi
    </h6>
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM log_activity ORDER BY created_at DESC LIMIT 5");

    if (mysqli_num_rows($query) == 0) {
    ?>
        <div class="dropdown-item d-flex align-items-center justify-content-center">
            <div>
                <span class="font-weight-bold text-center">Tidak Ada Notifikasi</span>
            </div>
        </div>
        <?php
    } else {
        while ($data = mysqli_fetch_array($query)) {
            $icon;
            $type = $data['type'];

            if ($type == "success") {
                $icon = "check";
            } else if ($type == "warning") {
                $icon = "exclamation-triangle";
            } else if ($type == "danger") {
                $icon = "times";
            } else {
                $icon = "info";
            }
        ?>

            <button class="dropdown-item d-flex align-items-center" style="<?= $data['is_read'] == 1 ? 'background-color: #f8f9fc' : '' ?>" type="submit">
                <div class="mr-3">
                    <div class="icon-circle bg-<?= $type ?>">
                        <i class="fas fa-<?= $icon ?> text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">
                        <?= date('d M Y', strtotime($data['created_at'])) ?>,
                        <?= date('H:i', strtotime($data['created_at'])) ?>
                    </div>
                    <span class="font-weight-bold"><?= $data['message'] ?></span>
                </div>
            </button>

    <?php }
    } ?>

    <form method="post">
        <button class="dropdown-item text-center small text-gray-500" type="submit" name="showAllNotif">Tampilkan semua
            notifikasi</button>
    </form>
    <form method="post">

        <button class="dropdown-item text-center small text-light bg-primary" type="submit" name="readAll">Tandai telah
            dibaca</button>
    </form>
</div>