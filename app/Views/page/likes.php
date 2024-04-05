<?= $this->extend('layout') ?>

<?= $this->section('body') ?>

<div class="col-12 overflow-hidden" style="max-height:300px">
    <!-- Photo by Pixabay: https://www.pexels.com/photo/abstract-board-game-bundle-business-267355/ -->
    <img src="<?php echo base_url("assets/image/pexels-pixabay-267355.jpg") ?>" alt="" class="img-fluid" style="object-fit: fill;">
</div>
<br>
<div class="p-2 d-flex justify-content-center flex-column align-items-center">
    <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 search-item" for="searchLikes" style="max-width: 500px;">
        <div class="p-2">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <input type="text" name="searchLikes" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="title, author or publisher" id="searchLikes">
        <div class="p-2">

        </div>
    </label>
    <i style="color:var(--color-3);">Press 'enter' to search</i>
</div>

<div class="p-2">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <h2 style="color:var(--color-3)" class="col-12 col-md-8 text-center text-md-start"><i class="fa-solid fa-heart color-4" style="background-color: transparent;"></i> User Likes </h2>
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
            <div class="p-2 col-6">
                <div class="select-box position-relative d-flex" data-type="bylikes">
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
                                    <input type="radio" name="sort" id="ASC" value="ASC" checked hidden>
                                    <span class="item-label">ASC</span>
                                </label>
                            </li>
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="DESC" class="w-100 h-100 p-2">
                                    <input type="radio" name="sort" id="DESC" value="DESC" hidden><span class="item-label">DESC</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="p-2 col-6">
                <div class="select-box position-relative d-flex" data-type="bylikes">
                    <div class="color-3 flex-fill p-2 style-2 rounded-pill d-flex justify-content-between align-items-center">
                        <label class="w-100 h-100">
                            <input type="checkbox" class="select-activate" hidden>
                            <span class="select-label">Title</span>
                        </label>
                        <span><i class="fa-solid fa-sort"></i></span>
                    </div>
                    <div class="select-list position-absolute color-3 style-2 w-100 d-none">
                        <ul class="list-group">
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="Title" class="w-100 h-100 p-2">
                                    <input type="radio" name="sortType" id="Title" value="Book.title" checked hidden><span class="item-label">Title</span>
                                </label>
                            </li>
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="Author" class="w-100 h-100 p-2">
                                    <input type="radio" name="sortType" id="Author" value="Author.name" hidden><span class="item-label">Author</span>
                                </label>
                            </li>
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="Publisher" class="w-100 h-100 p-2">
                                    <input type="radio" name="sortType" id="Publisher" value="Publisher.name" hidden><span class="item-label">Publisher</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <hr>

    <!-- Daftar buku-buku -->
    <div class="d-flex flex-wrap" id="daftarBukuCont">
        <?php
        if (count($bookData) > 0) {
            for ($i = 0; $i < count($bookData); $i++) {
        ?>
                <div class="col-xl-2 col-lg-3 col-md-4 col-12 p-1">
                    <div class="d-flex flex-md-column flex-row flex-wrap style-2 h-100">
                        <div class="d-flex align-items-center justify-content-center col-md-12 col-4 js-fillcolor" style="height: 300px">
                            <img src="<?php echo base_url('administrator/image_upload/buku/' . $bookData[$i]['image']) ?>" class="card-img-menu" alt="<?= $bookData[$i]['image'] ?>">
                        </div>
                        <hr class="m-0 d-md-block d-none">
                        <div class="card-menu-body d-flex flex-grow-1 flex-column p-2 col-md-12 col-8 justify-content-md-start justify-content-center">
                            <h5 class="card-title"><?= $bookData[$i]['title'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted "><?php
                                                                        if (count($bookData[$i]['publisher']) > 0) {
                                                                            echo $bookData[$i]['publisher'][0]['name'];
                                                                        } else {
                                                                            echo "Unknown";
                                                                        }

                                                                        ?>
                            </h6>
                            <p class="card-text">
                                <?php
                                $author = "";
                                for ($j = 0; $j < count($bookData[$i]['author']); $j++) {
                                    if ($j == count($bookData[$i]['author']) - 1) {
                                        $author .= $bookData[$i]['author'][$j]['name'];
                                    } else {
                                        $author .= $bookData[$i]['author'][$j]['name'] . '; ';
                                    }
                                }
                                echo $author;
                                ?>
                            </p>
                        </div>
                        <div class="card-menu-footer w-100 col-12">
                            <button class="style-2 color-3 w-100 book-detail" data-id="<?php echo $bookData[$i]['id'] ?>">DETAIL</button>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="align-self-center text-center w-100" style="color:var(--color-2)">
                <i class="fa-solid fa-ghost" style="font-size:150px"></i>
                <br><br>
                <h3>ITEM NOT FOUND</h3>
                <p>Please try another keyword</p>
            </div>
        <?php
        }
        ?>

    </div>




</div>


<?= $this->endSection() ?>