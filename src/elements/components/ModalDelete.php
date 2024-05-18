<!-- Modal -->
<div class="modal fade" id="modalDelete<?= $id; ?><?= $idNameRow; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog w-25">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="modalDeleteLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <input type="hidden" name="<?= $idNameRow; ?>" value="<?= $id; ?>">
                <div class="modal-body text-center">
                    <span class="text-danger h1">
                        <i class="fas fa-exclamation-triangle "></i>
                    </span>
                    <p class="h5 mt-3">Yakin ingin menghapus data ini?</p>
                    <!-- <p class="m-0">ID: <?= $id; ?></p>
                    <p class="m-0">Nama Row: <?= $idNameRow; ?></p> -->

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary w-25" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger w-25" name="delete">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>