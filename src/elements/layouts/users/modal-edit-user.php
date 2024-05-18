<!-- Modal -->
<div class="modal fade" id="editModal<?= $row['id_user']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" class="text-left">
                <div class="modal-body">

                    <input type="number" name="id_user" value="<?= $row['id_user']; ?>" hidden>

                    <div class="form-group">
                        <label for="nama_user<?= $row['id_user']; ?>">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_user<?= $row['id_user']; ?>" name="nama_user" value="<?= $row['nama_user']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email<?= $row['id_user']; ?>">Email</label>
                        <input type="email" class="form-control" id="email<?= $row['id_user']; ?>" name="email" value="<?= $row['email']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="username<?= $row['id_user']; ?>">Username</label>
                        <input type="text" class="form-control" id="username<?= $row['id_user']; ?>" name="username" value="<?= $row['username']; ?>" required>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="reset-password<?= $row['id_user']; ?>">
                            <label class="form-check-label user-select-none" for="reset-password<?= $row['id_user']; ?>">
                                Reset Password
                            </label>
                        </div>
                    </div>

                    <div class="form-group d-none" id="password-user<?= $row['id_user']; ?>">
                        <label for="password<?= $row['id_user']; ?>">Password</label>
                        <input type="password" class="form-control" id="password<?= $row['id_user']; ?>" name="password" placeholder="Password" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="edit_user">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // JavaScript untuk menangani perubahan status checkbox
    document.getElementById("reset-password<?= $row['id_user']; ?>").addEventListener('change', function() {
        if (this.checked) {
            document.getElementById("password-user<?= $row['id_user']; ?>").classList.remove('d-none');
        } else {
            document.getElementById("password-user<?= $row['id_user']; ?>").classList.add('d-none');
        }
    });
</script>