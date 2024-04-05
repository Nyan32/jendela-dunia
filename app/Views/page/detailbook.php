<?= $this->extend('layout') ?>

<?= $this->section('body') ?>

<div class="col-12 overflow-hidden" style="max-height:300px">
    <!-- Photo by Element5 Digital: https://www.pexels.com/photo/assorted-books-on-book-shelves-1370295/ -->
    <img src="<?php echo base_url("assets/image/pexels-element-digital-1370295.jpg") ?>" alt="" class="img-fluid" style="object-fit: fill;">
</div>
<div id="errorNotif">
    <?php
    if ($error != null) {
    ?>
        <ul class="alert-danger mb-0 p-2" id="errorList">
            <li><i class="fa-solid fa-circle-xmark"></i> <?= $error ?></li>
        </ul>
        <script>

        </script>
    <?php
    }
    ?>
</div>
<br>

<div class="p-2">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <h2 style="color:var(--color-3)" class="col-12 col-md-8 text-center text-md-start">Book Detail</h2>
    </div>
    <hr>

    <!-- Detail buku -->
    <div class="d-flex flex-wrap" style="color: var(--color-3)">
        <?php
        if ($bookData != null) {
        ?>
            <div class="col-12 col-md-3 p-2">
                <div class="p-2 js-fillcolor rounded" style="height:300px">
                    <img src="<?php echo base_url('administrator/image_upload/buku/' . $bookData[0]['image']) ?>" class="card-img-menu" alt="<?= $bookData[0]['image'] ?>">
                </div>
            </div>

            <div class="col-12 col-md-9 p-2">
                <h1><?= $bookData[0]['title'] ?></h1>
                <h5><i class="fa-solid fa-filter"></i> <?php echo ucwords($bookData[0]['category']) ?></h5>
                <h5><i class="fa-solid fa-calendar"></i> <?php echo ucwords($bookData[0]['year']) ?></h5>
                <div class="d-flex flex-wrap align-items-center h5">
                    <i class="fa-solid fa-grip pe-1 h-100"></i>
                    <div class="flex-fill text-break">
                        <?php
                        $genre = "";
                        for ($j = 0; $j < count($bookData[0]['genre']); $j++) {
                            if ($j == count($bookData[0]['genre']) - 1) {
                                $genre .= $bookData[0]['genre'][$j]['name'];
                            } else {
                                $genre .= $bookData[0]['genre'][$j]['name'] . '; ';
                            }
                        }
                        echo $genre;
                        ?>
                    </div>
                </div>
                <div>
                    <span id="likeBtnCont">
                        <?php
                        if ($alreadyLiked == false) {
                        ?>
                            <form action="<?php echo base_url('detailbook/likeprocess') ?>" class="d-inline" method="post">
                                <?= csrf_field() ?>
                                <button class="color-4 style-3" name="like" value="<?= $bookData[0]['id'] ?>"><i class="fa-solid fa-heart"></i> Like</button>
                            </form>
                        <?php
                        } else {
                        ?>
                            <form action="<?php echo base_url('detailbook/unlikeprocess') ?>" class="d-inline" method="post">
                                <?= csrf_field() ?>
                                <button class="color-2 style-2" name="unlike" value="<?= $bookData[0]['id'] ?>"><i class="fa-solid fa-heart-crack"></i> Unlike</button>
                            </form>
                        <?php
                        }
                        ?>
                    </span>

                    <span id="borrowBtnCont">
                        <?php
                        if ($alreadyBorrowed == false) {
                        ?>
                            <form action="<?php echo base_url('detailbook/borrowprocess') ?>" class="d-inline" method="post">
                                <?= csrf_field() ?>
                                <button class="color-3 style-2" name="borrow" value="<?= $bookData[0]['id'] ?>"><i class="fa-solid fa-plus"></i> Borrow</button>
                            </form>
                        <?php
                        } else {
                        ?>
                            <form action="<?php echo base_url('detailbook/returnprocess') ?>" class="d-inline" method="post">
                                <?= csrf_field() ?>
                                <button class="color-3 style-2" name="return" value="<?= $bookData[0]['id'] ?>"><i class="fa-solid fa-minus"></i> Return</button>
                            </form>
                        <?php
                        }
                        ?>
                    </span>


                </div>
            </div>
            <div class="col-12 p-2">
                <h5><i class="fa-solid fa-book-open"></i> Synopsis:</h5>
                <hr>
                <?php
                if ($bookData[0]['synopsis'] == '') {
                ?>
                    <div class="p-5 text-center" style="font-size: 20px; color:var(--color-3)">
                        There is no synopsis
                    </div>
                <?php
                } else {
                ?>
                    <div class="style-4 p-4">
                        <?= nl2br($bookData[0]['synopsis']) ?>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-12 p-2">
                <h5><i class="fa-solid fa-user-group"></i> Author(s):</h5>
                <hr>
                <div class="d-flex flex-wrap">
                    <?php
                    if (count(($bookData[0]['author'])) > 0) {
                        for ($i = 0; $i < count($bookData[0]['author']); $i++) {
                    ?>
                            <div class="d-flex flex-md-column flex-row flex-wrap style-4 col-xl-2 col-lg-3 p-4 col-md-4 col-12 m-1">
                                <div class="d-flex align-items-center justify-content-center col-md-12 col-4" style="height: 300px">
                                    <img src="<?php echo base_url('administrator/image_upload/penulis/' . $bookData[0]['author'][$i]['image']) ?>" class="card-img-menu" alt="<?= $bookData[0]['author'][$i]['image'] ?>">
                                </div>
                                <hr class="m-0 d-none d-md-block">
                                <div class="card-menu-body d-flex flex-grow-1 flex-column p-2 col-md-12 col-8 justify-content-md-start justify-content-center">
                                    <h5 class="card-title"><?= $bookData[0]['author'][$i]['name'] ?></h5>
                                    <h6 class="card-subtitle mb-2"><?= date("d F Y", strtotime($bookData[0]['author'][$i]['birthdate'])); ?></h6>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="p-5 text-center col-12" style="font-size: 20px; color:var(--color-3)">
                            Author(s) is unknown
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-12 p-2">
                <h5><i class="fa-solid fa-building"></i> Publisher:</h5>
                <hr>
                <?php
                if (count($bookData[0]['publisher']) > 0) {
                ?>
                    <div class="d-flex flex-wrap flex-column align-items-center justify-content-center p-4 js-fillcolor autotext-color rounded position-relative" style="filter: invert(100%); -webkit-filter: invert(100%);-moz-filter: invert(100%);-o-filter: invert(100%);-ms-filter: invert(100%);">
                        <div class="d-flex align-items-center justify-content-center col-md-12 p-2 rounded" style="height: 200px">
                            <img src="<?php echo base_url('administrator/image_upload/penerbit/' . $bookData[0]['publisher'][0]['image']) ?>" class="card-img-menu" alt="<?= $bookData[0]['publisher'][0]['image'] ?>" style="filter: invert(100%); -webkit-filter: invert(100%); -moz-filter: invert(100%); -o-filter: invert(100%); -ms-filter: invert(100%);">
                        </div>
                        <hr style="color:inherit" class="w-100">
                        <h5 class="card-title text-center"><?= $bookData[0]['publisher'][0]['name'] ?></h5>
                        <h6 class="card-title text-center"><?= $bookData[0]['publisher'][0]['address'] ?></h6>
                    </div>
                <?php
                } else {
                ?>
                    <div class="p-5 text-center" style="font-size: 20px; color:var(--color-3)">
                        Publisher is unknown
                    </div>
                <?php
                }
                ?>

            </div>
        <?php
        } else {
        ?>
            <div class="align-self-center text-center w-100" style="color:var(--color-2)">
                <i class="fa-solid fa-ghost" style="font-size:150px"></i>
                <br><br>
                <h3>ITEM NOT FOUND</h3>
            </div>
    </div>

<?php
        }
?>
</div>
</div>


<?= $this->endSection() ?>