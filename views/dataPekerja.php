<div class="card mb-4">
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Data Pekerja</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">+ Tambah
                Data</button>
        </div>

        <?php include_once './src/elements/layouts/data-pekerja/modal-tambah-pekerja.php' ?>

        <div class="table-responsive">
            <table class="table table-bordered display nowrap" id="data-pekerja" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Hp</th>
                        <th>Mulai Kerja</th>
                        <th>Berakhir Kerja</th>
                        <th>Bagian</th>
                        <th data-dt-order="disable">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    require 'pagesControl/dataPekerjaPage.php';

                    $no = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        setlocale(LC_TIME, 'id_ID');
                        $idNameRow = 'id_pekerja';
                        $id = $row[$idNameRow];
                    ?>
                        <tr class="text-center">
                            <td><?= $no; ?></td>
                            <td><?= $row['nama_pekerja']; ?></td>
                            <td><?= $row['alamat']; ?></td>
                            <td><?= $row['no_hp']; ?></td>
                            <td><?= date("d M Y", strtotime($row['mulai_kerja'])); ?></td>
                            <td><?= date("d M Y", strtotime($row['berakhir_kerja'])); ?></td>
                            <td><?= $row['bagian']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $id; ?>">Edit</button>
                                <?php include './src/elements/layouts/data-pekerja/modal-edit-pekerja.php' ?>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete<?= $id; ?><?= $idNameRow; ?>">
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