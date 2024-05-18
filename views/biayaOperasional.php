<div class="card col-8">
    <div class="card-body">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Biaya Operasional</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">+ Tambah
                Data</button>
        </div>

        <?php include './src/elements/layouts/biaya-operasional/modal-tambah-biaya-operasional.php' ?>

        <table class="table table-bordered" id="biaya-operasional" width="100%" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Akun</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th data-dt-order="disable">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                require 'pagesControl/biayaOperasionalPage.php';

                $prev_nama_akun = "";
                while ($row = mysqli_fetch_assoc($result)) {
                    $no = $row['urutan'];
                    $idNameRow = 'id_bo';
                    $id = $row[$idNameRow];
                    $nama_akun = $row["nama_akun"];


                    if ($nama_akun != $prev_nama_akun) {
                        $no = 1;
                    }
                ?>
                <tr class="text-center">

                    <td><?= $no; ?></td>
                    <td><?= date("d M Y", strtotime($row['tanggal_bo'])); ?></td>
                    <td><?= $row['nama_akun']; ?></td>
                    <td><?= $row['keterangan']; ?></td>
                    <td>Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#editModal<?= $id; ?>">Edit</button>
                        <?php require './src/elements/layouts/biaya-operasional/modal-edit-biaya-operasional.php'; ?>

                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#modalDelete<?= $id; ?><?= $idNameRow; ?>">
                            Hapus
                        </button>
                        <?php include 'src/elements/components/ModalDelete.php'; ?>
                    </td>

                </tr>
                <?php
                    $prev_nama_akun = $nama_akun;
                    $no++;
                } ?>

            </tbody>
        </table>

    </div>
</div>