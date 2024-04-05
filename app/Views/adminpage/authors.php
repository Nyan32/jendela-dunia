<?= $this->extend('layoutadmin') ?>

<?= $this->section('body') ?>

<br>
<div class="p-2 d-flex justify-content-center flex-column align-items-center">
    <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 search-item" for="searchAuthor" style="max-width: 500px;">
        <div class="p-2">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <input type="text" name="searchAuthor" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="name" id="searchAuthor">
        <div class="p-2">

        </div>
    </label>
    <i style="color:var(--color-3);">Press 'enter' to search</i>
</div>

<div class="p-2">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <h2 style="color:var(--color-3)" class="col-12 col-md-8 text-center text-md-start"><i class="fa-solid fa-user-group"></i> Author List</h2>
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
            <div class="p-2 col-12">
                <div class="select-box position-relative d-flex" data-type="sortAuthors">
                    <div class="color-3 flex-fill p-2 style-2 rounded-pill">
                        <label class="w-100 h-100 d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" class="select-activate" hidden>
                                <span class="select-label">ASC</span>
                            </div>
                            <span><i class="fa-solid fa-sort"></i></span>
                        </label>
                    </div>
                    <div class="select-list position-absolute color-3 style-2 w-100 d-none">
                        <ul class="list-group">
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="ASC" class="w-100 h-100 p-2">
                                    <input type="radio" name="sortAuthors" id="ASC" value="ASC" checked hidden>
                                    <span class="item-label">ASC</span>
                                </label>
                            </li>
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="DESC" class="w-100 h-100 p-2">
                                    <input type="radio" name="sortAuthors" id="DESC" value="DESC" hidden><span class="item-label">DESC</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <!-- Daftar penulis -->
    <div class="d-flex flex-wrap" id="daftarAuthorCont" style="color: var(--color-3)">
        <div class="col-xl-2 col-lg-3 col-md-4 col-12 p-1">
            <div class="d-flex h-100">
                <button class="card-menu-body d-flex flex-column flex-wrap flex-grow-1 style-2 color-3 p-5 justify-content-center align-items-center col-12 h-100" id="addAuthorBtn">
                    <i class="fa-solid fa-circle-plus p-1" style="font-size:50px"></i>
                    <p class="p-1">Add author</p>
                </button>
            </div>
        </div>
        <?php
        for ($i = 0; $i < count($authorData); $i++) {
        ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-12 p-1">
                <div class="d-flex flex-md-column flex-row flex-wrap style-2 h-100">
                    <div class="d-flex align-items-center justify-content-center col-md-12 col-4 js-fillcolor" style="height: 300px">
                        <img src="<?php echo base_url('administrator/image_upload/penulis/' . $authorData[$i]['image']) ?>" class="card-img-menu" alt="<?= $authorData[$i]['image'] ?>">
                    </div>
                    <hr class="m-0 d-none d-md-block">
                    <div class="card-menu-body d-flex flex-grow-1 flex-column p-2 col-md-12 col-8 justify-content-md-start justify-content-center">
                        <h5 class="card-title mb-2">ID: <?= $authorData[$i]['id'] ?></h5>
                        <h6 class="card-title"><?= $authorData[$i]['name'] ?></h6>
                        <h6 class="card-subtitle mb-2"><?= date("d F Y", strtotime($authorData[$i]['birthdate'])); ?></h6>
                    </div>
                    <div class="card-menu-footer d-flex col-12 flex-wrap">
                        <button class="color-3 style-2 col-6 editAuthorBtn" data-id="<?= $authorData[$i]['id'] ?>">Edit</button>
                        <form action="" class="d-inline col-6" method="POST">
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                            <button class="w-100 h-100 color-2 style-1" name="id" value="<?= $authorData[$i]['id'] ?>">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>




</div>


<?= $this->endSection() ?>