<?= $this->extend('layoutadmin') ?>

<?= $this->section('body') ?>

<div id="errorNotif">
    <?php
    if (is_array($errorRes) === true && count($errorRes) > 0) {
    ?>
        <ul class="alert-danger mb-0 p-2" id="errorList">
            <?php
            foreach ($errorRes as $key => $errorRes) {
            ?>
                <li><i class="fa-solid fa-circle-xmark"></i> <?= $errorRes ?></li>
            <?php
            }
            ?>
        </ul>
    <?php
    }
    ?>
</div>

<br>

<div class="container align-self-center d-flex justify-content-center align-items-center w-100 flex-grow-1" style="max-width: 600px;">
    <div class="w-100 flex-column">
        <h2 style="color: var(--color-3)">
            <?php
            if ($authorData != null) {
                echo 'Edit Author';
            } else {
                echo 'Add Author';
            }
            ?>
        </h2>
        <hr>
        <form action="" class="w-100 h-100" method="post" enctype="multipart/form-data">
            <h2 class="p-2 text-center" style="color:var(--color-3)"></h2>
            <?= csrf_field() ?>

            <?php
            if ($authorData != null) {
            ?>
                <div>
                    <input type="hidden" name="id" value="<?= $authorData[0]['id'] ?>">
                </div>
            <?php
            }
            ?>

            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="name">
                    <div class="p-2">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" name="name" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Name" id="name" value="<?php if ($authorData != null) {
                                                                                                                                                                    echo $authorData[0]['name'];
                                                                                                                                                                } else {
                                                                                                                                                                    if ($lastInputData != null)
                                                                                                                                                                        echo $lastInputData['name'];
                                                                                                                                                                    else
                                                                                                                                                                        echo '';
                                                                                                                                                                } ?>">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="birthdate">
                    <div class="p-2">
                        <i class="fa-solid fa-cake-candles"></i>
                    </div>
                    <input type="date" name="birthdate" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" id="birthdate" value="<?php
                                                                                                                                                        if ($authorData != null) {
                                                                                                                                                            echo $authorData[0]['birthdate'];
                                                                                                                                                        } else {
                                                                                                                                                            if ($lastInputData != null)
                                                                                                                                                                echo $lastInputData['birthdate'];
                                                                                                                                                            else
                                                                                                                                                                echo '';
                                                                                                                                                        }
                                                                                                                                                        ?>">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 imgUpload" for="imageAuthor">
                    <div class="p-2">
                        <i class="fa-solid fa-file-image"></i>
                    </div>
                    <label class="imgText flex-grow-1 text-truncate" for="imageAuthor">
                        <?php
                        if ($authorData != null) {
                            echo $authorData[0]['image'];
                        } else {
                            echo 'Upload file';
                        }
                        ?>
                    </label>
                    <input type="hidden" name="imageStatus" value="<?php
                                                                    if ($authorData != null) {
                                                                        echo 'keep';
                                                                    } else {
                                                                        echo 'add';
                                                                    }
                                                                    ?>">
                    <input type="file" name="imageAuthor" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" id="imageAuthor" hidden>
                    <div>
                        <button type="button" id="deleteImage" class="color-3 flex-shrink-0 border-0">Delete</button>
                    </div>
                </label>
            </div>
            <div class="p-2 text-center">
                <button type="input" class="color-3 style-2">Submit</button>
            </div>
        </form>
    </div>

</div>

<br>

<?= $this->endSection() ?>