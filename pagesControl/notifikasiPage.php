<?php
require 'config/config.php';

$limit = 10;
$sqlCount = mysqli_query($koneksi, "SELECT * FROM log_activity");
$totalRows = mysqli_num_rows($sqlCount);
$totalPages = ceil($totalRows / $limit);
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($currentPage - 1) * $limit;
$query = mysqli_query($koneksi, "SELECT * FROM log_activity ORDER BY created_at DESC LIMIT $limit OFFSET $offset");


?>

<div class="card col-md-8">
    <div class="card-body">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Notifikasi</h1>
        </div>

        <div class="accordion" id="accordion">
            <?php
            if (mysqli_num_rows($query) == 0) {
                echo "Tidak ada notifikasi";
            } else {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                    <div class="card">
                        <div class="card-header" id="heading<?= $row['id']; ?>">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $row['id']; ?>" aria-expanded="true" aria-controls="collapse<?= $row['id']; ?>">
                                    <?= $row['created_at'] ?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse<?= $row['id']; ?>" class="collapse show" aria-labelledby="heading<?= $row['id']; ?>" data-parent="#accordion">
                            <div class="card-body">
                                <?= $row['message'] ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>