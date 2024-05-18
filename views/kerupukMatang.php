<div class="card">
    <div class="card-body">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Kerupuk Matang</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">+ Tambah
                Data</button>
        </div>

        <?php

        $query = mysqli_query($koneksi, "SELECT saldo_harga FROM kerupuk_matang ORDER BY id_mtg DESC LIMIT 1");
        $row = mysqli_fetch_array($query);

        require './src/elements/layouts/kerupuk-matang/modal-tambah-kerupuk-matang.php'; ?>

        <div class="table-responsive">
            <table class="table table-bordered display nowrap" id="kerupuk-matang" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">No. Invoice</th>
                        <th rowspan="2">Keterangan</th>
                        <th colspan="3" data-dt-order="disable">Barang Masuk</th>
                        <th colspan="3" data-dt-order="disable">Barang Keluar</th>
                        <th colspan="3" data-dt-order="disable">Saldo</th>
                        <th rowspan="2" data-dt-order="disable">Action</th>
                    </tr>
                    <tr>
                        <th>Hasil Produksi Per Kg</th>
                        <th>Harga Per Kg</th>
                        <th>Total Biaya</th>
                        <th>Kuantitas</th>
                        <th>Harga Per Kg</th>
                        <th>Total Biaya</th>
                        <th>Kuantitas</th>
                        <th>Harga Per Kg</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    require 'pagesControl/kerupukMatangPage.php';

                    $no = 1;
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $idNameRow = 'id_mtg';
                        $id = $row[$idNameRow];
                    ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
                            <td><?= $row['no_invoice']; ?></td>
                            <td><?= $row['keterangan']; ?></td>
                            <td><?= $row['bm_qty']; ?></td>
                            <td>Rp <?= number_format($row['bm_harga'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($row['bm_total'], 0, ',', '.'); ?></td>
                            <td><?= $row['bk_qty']; ?></td>
                            <td>Rp <?= number_format($row['bk_harga'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($row['bk_total'], 0, ',', '.'); ?></td>
                            <td><?= $row['saldo_qty']; ?></td>
                            <td>Rp <?= number_format($row['saldo_harga'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($row['saldo_total'], 0, ',', '.'); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $id; ?>" <?= $id === $rowIdLasted[$idNameRow] ? '' : 'hidden'; ?>>Edit</button>
                                <?php require './src/elements/layouts/kerupuk-matang/modal-edit-kerupuk-matang.php'; ?>

                                <button type="button" class="btn btn-danger <?= $id === $rowIdLasted[$idNameRow] ? '' : 'btn-block'; ?>" data-toggle="modal" data-target="#modalDelete<?= $id; ?><?= $idNameRow; ?>">
                                    Hapus
                                </button>
                                <?php include 'src/elements/components/ModalDelete.php'; ?>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>