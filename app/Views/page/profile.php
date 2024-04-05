<?= $this->extend('layout') ?>

<?= $this->section('body') ?>

<div id="errorNotif">
    <?php
    if ($errorRes != null) {
    ?>
        <ul class="alert-danger mb-0 p-2" id="errorList">
            <li><i class="fa-solid fa-circle-xmark"></i> <?= $errorRes['payment'] ?></li>
        </ul>
        <script>

        </script>
    <?php
    }
    ?>
</div>

<h2 class="text-center p-3" style="color: var(--color-3)">Profile Card
</h2>
<div class="p-3 w-100 m-auto">
    <div class="container m-auto" style="max-width:500px;">
        <div class="p-3 shadow w-100 m-auto rounded position-relative" style="color: #E5D160; background-color: var(--color-3)">

            <h1 style="font-size: 20px;" class="text-wrap text-break"><?php echo $userData[0]['name'] ?></h1>
            <hr>

            <div class="position-relative">
                <div class="position-absolute d-flex align-items-center justify-content-center" style="width:100%; max-width:40px; top:-40px; left:85%">
                    <div class="rounded-circle color-3 d-flex align-items-center justify-content-center position-relative" style=" padding-top: 100%; width:100%;">
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <img src="<?php echo base_url('assets/image/logo.png') ?>" style="width:100%" alt="logo">
                        </div>
                    </div>

                </div>
                <p><?= date("d F Y", strtotime($userData[0]['birthdate'])); ?></p>
                <p><?php if ($userData[0]['gender'] == 'M') {
                        echo 'Male';
                    } else {
                        echo 'Female';
                    }
                    ?></p>
                <p><?php echo $userData[0]['phone'] ?></p>
                <p class="text-break" style="max-width: 70%;"><?php echo $userData[0]['address'] ?></p>
                <hr style="max-width: 70%;">
                <div class="d-flex align-items-center">
                    <p class="m-0" <?php
                                    if ($userData[0]['fine'] > 5000) {
                                        echo 'style="color:white"';
                                    }
                                    ?>>Rp. <?php
                                            echo $userData[0]['fine'];
                                            if ($userData[0]['fine'] > 5000) {
                                                echo ' (exceeded limit)';
                                            }
                                            ?></p>
                </div>
            </div>
            <!-- https://lovepik.com/images/png-books.html Books Png vectors by Lovepik.com -->
            <img class="position-absolute bottom-0 end-0" style="width:30%; z-index: 0;" src="<?php echo base_url('assets/image/Lovepik_com-400329383-a-set-of-papers-material.png') ?>" alt="">
        </div>
        <br>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="p-2 col-6 col-md-3 order-1 order-md-0">
                <button class="color-3 style-2 p-2 w-100" id="editProfile"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
            </div>
            <form action="profile/payfine" method="post" class="col-12 col-md-6 d-flex p-2 order-0 order-md-1">
                <?= csrf_field() ?>
                <input type="text" class="color-3 style-2 p-2 w-100" name="payment">
                <button class="color-3 style-2 p-2 text-nowrap" type="submit"><i class="fa-solid fa-cash-register flex-shrink-0"></i> Pay Fine</button>
            </form>
            <div class="p-2 col-6 col-md-3 order-2 order-md-2">
                <button class="color-2 style-1 p-2 w-100" id="logoutBtn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button>
            </div>
        </div>
    </div>
</div>

<div class="p-2">
    <h2 style="color:var(--color-3)" class="col-12 col-md-8 text-center text-md-start"><i class="fa-solid fa-book"></i> Borrowed Book </h2>
    <hr>

    <div class="d-flex flex-wrap justify-content-evenly" id="daftarBukuCont">
        <?php
        if (count($bookData) > 0) {
            for ($i = 0; $i < count($bookData); $i++) {
        ?>
                <div class="d-flex flex-md-column flex-row flex-wrap style-2 col-xl-2 col-lg-3 col-md-4 col-12 m-1">
                    <div class="d-flex align-items-center justify-content-center col-md-12 col-4 js-fillcolor" style="height: 300px">
                        <img src="<?php echo base_url('administrator/image_upload/buku/' . $bookData[$i]['image']) ?>" class="card-img-menu" alt="<?= $bookData[$i]['image'] ?>">
                    </div>
                    <hr class="m-0">
                    <div class="card-menu-body d-flex flex-grow-1 flex-column p-2 justify-content-center col-md-12 col-8">
                        <h5 class="card-title"><?= $bookData[$i]['title'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted "><?php
                                                                    if (count($bookData[$i]['publisher']) > 0) {
                                                                        echo $bookData[$i]['publisher'][0]['name'];
                                                                    } else {
                                                                        echo 'Unknown';
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
            <?php
            }
        } else {
            ?>
            <div class="align-self-center text-center w-100" style="color:var(--color-2)">
                <i class="fa-solid fa-ghost" style="font-size:150px"></i>
                <br><br>
                <h3>ITEM NOT FOUND</h3>
                <p>There is no borrowed books</p>
            </div>
        <?php
        }
        ?>
    </div>
</div>




<?= $this->endSection() ?>