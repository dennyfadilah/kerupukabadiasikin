<div class="card col-md-7 mb-4">
    <div class="card-body">

        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-2 text-gray-800">Akun</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">+ Tambah
                Data</button>
        </div>

        <?php include_once './src/elements/layouts/akun/modal-tambah-akun.php'; ?>

        <div class="table-responsive p-1">
            <table class="table table-bordered display nowrap" id="akun" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Nama Akun</th>
                        <th data-dt-order="disable">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    require 'pagesControl/akunPage.php';

                    $no = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        $idNameRow = 'id_akun';
                        $id = $row[$idNameRow];
                    ?>
                        <tr class="text-center">
                            <td><?= $no; ?></td>
                            <td><?= $row['nama_akun']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $id; ?>">
                                    Edit
                                </button>
                                <?php require './src/elements/layouts/akun/modal-edit-akun.php'; ?>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete<?= $id; ?><?= $idNameRow; ?>">
                                    Hapus
                                </button>
                                <?php require './src/elements/components/ModalDelete.php'; ?>
                            </td>
                        </tr>
                    <?php $no++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>