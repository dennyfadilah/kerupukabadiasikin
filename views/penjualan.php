<div class="card">
    <div class="card-body">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Penjualan</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">+ Tambah
                Data</button>
        </div>

        <?php include_once './src/elements/layouts/penjualan/modal-tambah-penjualan.php' ?>

        <div class="table-responsive">
            <table class="table table-bordered display nowrap" id="penjualan" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>No. Invoice</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Produk</th>
                        <th>Kuantitas</th>
                        <th>Harga Per Kg</th>
                        <th>Subtotal</th>
                        <th>Diskon</th>
                        <th>Harga Total</th>
                        <th data-dt-order="disable">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    require 'pagesControl/penjualanPage.php';

                    $no = 1;
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $idNameRow = 'id_pj';
                        $id = $row[$idNameRow];
                    ?>
                    <tr class="text-center">

                        <td><?= $no; ?></td>
                        <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
                        <td><?= $row['no_invoice']; ?></td>
                        <td><?= $row['nama_pelanggan'] === null ? '-' : $row['nama_pelanggan']; ?></td>
                        <td><?= $row['jenis_produk']; ?></td>
                        <td><?= $row['kuantitas'] === null ? 0 : $row['kuantitas']; ?> Kg</td>
                        <td>Rp <?= $row['harga_kg'] === null ? 0 : number_format($row['harga_kg'], 0, ',', '.'); ?></td>
                        <td>Rp <?= $row['subtotal'] === null ? 0 : number_format($row['subtotal'], 0, ',', '.'); ?></td>
                        <td>Rp <?= $row['diskon'] === null ? 0 : number_format($row['diskon'], 0, ',', '.'); ?></td>
                        <td>Rp
                            <?= $row['harga_total'] === null ? 0 : number_format($row['harga_total'], 0, ',', '.'); ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#editModal<?= $id; ?>"
                                <?= $id === $rowIdLasted[$idNameRow] ? '' : 'hidden'; ?>>Edit</button>
                            <?php include './src/elements/layouts/penjualan/modal-edit-penjualan.php' ?>

                            <button type="button"
                                class="btn btn-danger <?= $id === $rowIdLasted[$idNameRow] ? '' : 'btn-block'; ?>"
                                data-toggle="modal" data-target="#modalDelete<?= $id; ?><?= $idNameRow; ?>">
                                Hapus
                            </button>
                            <?php include 'src/elements/components/ModalDelete.php'; ?>
                        </td>

                    </tr>
                    <?php $no++;
                    } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>