<?= $this->extend('layoutadmin') ?>

<?= $this->section('body') ?>

<br>

<div class="p-2">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <h2 style="color:var(--color-3)" class="col-12 col-md-8 text-center text-md-start"><i class="fa-solid fa-grip"></i> Genre List</h2>
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
            <button class="color-3 style-2 h-100 w-100" id="addGenreBtn">Add Genre</button>
        </div>
    </div>
    <hr>

    <!-- Daftar penulis -->
    <div class="d-flex flex-wrap align-items-center" id="daftarGenreCont" style="color: var(--color-3)">
        <div class="col-2 border-end px-1 text-break">ID</div>
        <div class="col-6 border-end px-1 text-break">Genre name</div>
        <div class="col-4 px-1 text-break text-center">Action</div>
        <hr class="col-12">
        <?php
        for ($i = 0; $i < count($genreData); $i++) {
        ?>
            <div class="col-2 border-end px-1 text-break"><?= $genreData[$i]['id'] ?></div>
            <div class="col-6 border-end px-1 text-break"><?= $genreData[$i]['name'] ?></div>
            <div class="col-4 px-1 d-flex flex-wrap">
                <div class="px-1 flex-fill">
                    <button class="color-3 style-2 w-100 editGenreBtn" data-id="<?= $genreData[$i]['id'] ?>">Edit</button>
                </div>
                <div class="px-1 flex-fill">
                    <form action="" class="d-inline col-12 col-md-6" method="POST">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <button class="w-100 h-100 color-2 style-1" name="id" value="<?= $genreData[$i]['id'] ?>">Delete</button>
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