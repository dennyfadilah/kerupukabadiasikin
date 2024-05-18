<?php
require 'config/config.php';

$limit = 10;
$offset = 0;
$result = mysqli_query($koneksi, "SELECT * FROM log_activity ORDER BY created_at DESC LIMIT $limit OFFSET $offset");

?>

<div class="card col-md-8 mb-4">
    <div class="card-body">

        <h1 class="h3 mb-2 text-gray-800 mb-3">Notifikasi</h1>

        <div class="accordion" id="accordion">
            <?php if (mysqli_num_rows($result) == 0) : ?>
                <div class="alert alert-info">Tidak ada notifikasi</div>
            <?php else : ?>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="card">
                        <div class="card-header" id="heading<?= $row['id_log']; ?>">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $row['id_log']; ?>" aria-expanded="true" aria-controls="collapse<?= $row['id_log']; ?>">
                                    <?= $row['created_at'] ?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse<?= $row['id_log']; ?>" class="collapse show" aria-labelledby="heading<?= $row['id_log']; ?>" data-parent="#accordion">
                            <div class="card-body">
                                <?= $row['message'] ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

    </div>
</div>