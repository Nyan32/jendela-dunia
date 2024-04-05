<?= $this->extend('layoutadmin') ?>

<?= $this->section('body') ?>

<br>

<div class="p-2">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <h2 style="color:var(--color-3)" class="col-12 col-md-8 text-center text-md-start"><i class="fa-solid fa-user-group"></i> User List</h2>
    </div>
    <hr>

    <!-- Daftar penulis -->
    <div class="d-flex flex-wrap align-items-center" id="daftarGenreCont" style="color: var(--color-3)">
        <div class="col-8 border-end px-1 text-break">Email</div>
        <div class="col-4 px-1 text-break text-center">Action</div>
        <hr class="col-12">
        <?php
        for ($i = 0; $i < count($userData); $i++) {
        ?>
            <div class="col-8 border-end px-1 text-break"><?= $userData[$i]['email'] ?></div>
            <div class="col-4 px-1 d-flex flex-wrap justify-content-center">
                <div class="px-1 col-6">
                    <form action="<?= base_url('admin/users/reset') ?>" class="d-inline" method="POST">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <button class="w-100 h-100 color-4 style-3" name="email" value="<?= $userData[$i]['email'] ?>">Reset</button>
                    </form>
                </div>
                <div class="px-1 col-6">
                    <form action="<?= base_url('admin/users/control') ?>" class="d-inline" method="POST">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <?php
                        if ($userData[$i]['status'] == 'disable') {
                        ?>
                            <button class="w-100 h-100 color-3 style-2" name="email" value="<?= $userData[$i]['email'] ?>">Enable</button>
                        <?php
                        } else {
                        ?>
                            <button class="w-100 h-100 color-2 style-1" name="email" value="<?= $userData[$i]['email'] ?>">Disable</button>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
            <hr class="col-12">
        <?php
        }
        ?>
    </div>
</div>


<?= $this->endSection() ?>