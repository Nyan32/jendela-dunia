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
            if ($bookData != null) {
                echo 'Edit Book';
            } else {
                echo 'Add Book';
            }
            ?>
        </h2>
        <hr>
        <form action="" class="w-100 h-100" method="post" enctype="multipart/form-data">
            <h2 class="p-2 text-center" style="color:var(--color-3)"></h2>
            <?= csrf_field() ?>

            <?php
            if ($bookData != null) {
            ?>
                <div>
                    <input type="hidden" name="id" value="<?= $bookData[0]['id'] ?>">
                </div>
            <?php
            }
            ?>
            <!-- input title -->
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="title">
                    <div class="p-2">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <input type="text" name="title" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Title" id="title" value="<?php if ($bookData != null) {
                                                                                                                                                                        echo $bookData[0]['title'];
                                                                                                                                                                    } else {
                                                                                                                                                                        if ($lastInputData != null)
                                                                                                                                                                            echo $lastInputData['title'];
                                                                                                                                                                        else
                                                                                                                                                                            echo '';
                                                                                                                                                                    } ?>">
                    <div class="p-2"></div>
                </label>
            </div>

            <!-- input category -->
            <div class="p-2">
                <div class="select-box position-relative d-flex w-100">
                    <div class="color-3 flex-fill p-2 style-2 rounded-pill">
                        <label class="p-1 w-100 h-100 d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" class="select-activate" hidden>
                                <i class="fa-solid fa-filter"></i>
                                <span class="select-label">
                                    <?php
                                    if ($bookData != null) {
                                        if ($bookData[0]['category'] == 'non-fiction')
                                            echo 'Non-fiction';
                                        else if ($bookData[0]['category'] == 'fiction')
                                            echo 'Fiction';
                                    } else {
                                        if ($lastInputData != null) {
                                            if ($lastInputData['category'] == 'non-fiction')
                                                echo 'Non-fiction';
                                            else if ($lastInputData['category'] == 'fiction')
                                                echo 'Fiction';
                                        } else
                                            echo 'Non-fiction';
                                    }
                                    ?>
                                </span>
                            </div>
                            <span><i class="fa-solid fa-sort"></i></span>
                        </label>
                    </div>
                    <div class="select-list position-absolute color-3 style-2 w-100 d-none">
                        <ul class="list-group">
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="non-fiction" class="w-100 h-100 p-2">
                                    <input type="radio" name="category" id="non-fiction" value="non-fiction" <?php
                                                                                                                if ($bookData != null) {
                                                                                                                    if ($bookData[0]['category'] == 'non-fiction')
                                                                                                                        echo 'checked';
                                                                                                                } else {
                                                                                                                    if ($lastInputData != null) {
                                                                                                                        if ($lastInputData['category'] == 'non-fiction')
                                                                                                                            echo 'checked';
                                                                                                                    } else
                                                                                                                        echo 'checked';
                                                                                                                }
                                                                                                                ?> hidden>
                                    <span class="item-label">Non-Fiction</span>
                                </label>
                            </li>
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="fiction" class="w-100 h-100 p-2">
                                    <input type="radio" name="category" id="fiction" value="fiction" <?php
                                                                                                        if ($bookData != null) {
                                                                                                            if ($bookData[0]['category'] == 'fiction')
                                                                                                                echo 'checked';
                                                                                                        } else {
                                                                                                            if ($lastInputData != null) {
                                                                                                                if ($lastInputData['category'] == 'fiction')
                                                                                                                    echo 'checked';
                                                                                                            }
                                                                                                        }
                                                                                                        ?> hidden>
                                    <span class="item-label">Fiction</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- input year -->
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="year">
                    <div class="p-2">
                        <i class="fa-solid fa-calendar"></i>
                    </div>
                    <input type="text" name="year" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Year" id="year" value="<?php if ($bookData != null) {
                                                                                                                                                                    echo $bookData[0]['year'];
                                                                                                                                                                } else {
                                                                                                                                                                    if ($lastInputData != null)
                                                                                                                                                                        echo $lastInputData['year'];
                                                                                                                                                                    else
                                                                                                                                                                        echo '';
                                                                                                                                                                } ?>">
                    <div class="p-2"></div>
                </label>
            </div>

            <!-- input amount -->
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="amount">
                    <div class="p-2">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <input type="text" name="amount" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Amount" id="amount" value="<?php if ($bookData != null) {
                                                                                                                                                                            echo $bookData[0]['amount'];
                                                                                                                                                                        } else {
                                                                                                                                                                            if ($lastInputData != null)
                                                                                                                                                                                echo $lastInputData['amount'];
                                                                                                                                                                            else
                                                                                                                                                                                echo '';
                                                                                                                                                                        } ?>">
                    <div class="p-2"></div>
                </label>
            </div>

            <!-- input status -->
            <div class="p-2">
                <div class="select-box position-relative d-flex w-100">
                    <div class="color-3 flex-fill p-2 style-2 rounded-pill">
                        <label class="p-1 w-100 h-100 d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" class="select-activate" hidden>
                                <i class="fa-solid fa-flag"></i>
                                <span class="select-label">
                                    <?php
                                    if ($bookData != null) {
                                        if ($bookData[0]['status'] == 'available')
                                            echo 'Available';
                                        else if ($bookData[0]['status'] == 'unavailable')
                                            echo 'Unavailable';
                                    } else {
                                        if ($lastInputData != null) {
                                            if ($lastInputData['status'] == 'available')
                                                echo 'Available';
                                            else if ($lastInputData['status'] == 'unavailable')
                                                echo 'Unavailable';
                                        } else
                                            echo 'Available';
                                    }
                                    ?>
                                </span>
                            </div>
                            <span><i class="fa-solid fa-sort"></i></span>
                        </label>
                    </div>
                    <div class="select-list position-absolute color-3 style-2 w-100 d-none">
                        <ul class="list-group">
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="available" class="w-100 h-100 p-2">
                                    <input type="radio" name="status" id="available" value="available" <?php
                                                                                                        if ($bookData != null) {
                                                                                                            if ($bookData[0]['status'] == 'available')
                                                                                                                echo 'checked';
                                                                                                        } else {
                                                                                                            if ($lastInputData != null) {
                                                                                                                if ($lastInputData['status'] == 'available')
                                                                                                                    echo 'checked';
                                                                                                            } else
                                                                                                                echo 'checked';
                                                                                                        }
                                                                                                        ?> hidden>
                                    <span class="item-label">Available</span>
                                </label>
                            </li>
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="unavailable" class="w-100 h-100 p-2">
                                    <input type="radio" name="status" id="unavailable" value="unavailable" <?php
                                                                                                            if ($bookData != null) {
                                                                                                                if ($bookData[0]['status'] == 'unavailable')
                                                                                                                    echo 'checked';
                                                                                                            } else {
                                                                                                                if ($lastInputData != null) {
                                                                                                                    if ($lastInputData['status'] == 'unavailable')
                                                                                                                        echo 'checked';
                                                                                                                }
                                                                                                            }
                                                                                                            ?> hidden>
                                    <span class="item-label">Unavailable</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- input synopsis -->
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded border-1 color-3 style-2 w-100" for="synopsis">
                    <div class="p-2">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <textarea name="synopsis" class="flex-grow-1 rounded color-3 border-0" placeholder="Synopsis" style="outline: none; min-height:100px" id="synopsis"><?php
                                                                                                                                                                        if ($bookData != null) {
                                                                                                                                                                            echo $bookData[0]['synopsis'];
                                                                                                                                                                        } else {
                                                                                                                                                                            if ($lastInputData != null)
                                                                                                                                                                                echo $lastInputData['synopsis'];
                                                                                                                                                                            else
                                                                                                                                                                                echo '';
                                                                                                                                                                        }
                                                                                                                                                                        ?></textarea>
                    <div class="p-2"></div>
                </label>
            </div>

            <!-- input publisher_id -->
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="publisher_id">
                    <div class="p-2">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <input type="text" name="publisher_id" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Publisher ID" id="publisher_id" value="<?php if ($bookData != null) {
                                                                                                                                                                                            echo $bookData[0]['publisher_id'];
                                                                                                                                                                                        } else {
                                                                                                                                                                                            if ($lastInputData != null)
                                                                                                                                                                                                echo $lastInputData['publisher_id'];
                                                                                                                                                                                            else
                                                                                                                                                                                                echo '';
                                                                                                                                                                                        } ?>">
                    <div class="p-2"></div>
                </label>
            </div>

            <!-- input author_id -->
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="author_id">
                    <div class="p-2">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <input type="text" name="author_id" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Author ID (if more than one, seperate it with colon ':')" id="author_id" value="<?php if ($bookData != null) {
                                                                                                                                                                                                                                    echo $bookData[0]['author_id'];
                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                    if ($lastInputData != null)
                                                                                                                                                                                                                                        echo $lastInputData['author_id'];
                                                                                                                                                                                                                                    else
                                                                                                                                                                                                                                        echo '';
                                                                                                                                                                                                                                } ?>">
                    <div class="p-2"></div>
                </label>
            </div>

            <!-- input genre_id -->
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="genre_id">
                    <div class="p-2">
                        <i class="fa-solid fa-grip"></i>
                    </div>
                    <input type="text" name="genre_id" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Genre ID (if more than one, seperate it with colon ':')" id="genre_id" value="<?php if ($bookData != null) {
                                                                                                                                                                                                                                echo $bookData[0]['genre_id'];
                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                if ($lastInputData != null)
                                                                                                                                                                                                                                    echo $lastInputData['genre_id'];
                                                                                                                                                                                                                                else
                                                                                                                                                                                                                                    echo '';
                                                                                                                                                                                                                            } ?>">
                    <div class="p-2"></div>
                </label>
            </div>

            <!-- input image -->
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 imgUpload" for="imageBook">
                    <div class="p-2">
                        <i class="fa-solid fa-file-image"></i>
                    </div>
                    <label class="imgText flex-grow-1 text-truncate" for="imageBook">
                        <?php
                        if ($bookData != null) {
                            echo $bookData[0]['image'];
                        } else {
                            echo 'Upload file';
                        }
                        ?>
                    </label>
                    <input type="hidden" name="imageStatus" value="<?php
                                                                    if ($bookData != null) {
                                                                        echo 'keep';
                                                                    } else {
                                                                        echo 'add';
                                                                    }
                                                                    ?>">
                    <input type="file" name="imageBook" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" id="imageBook" hidden>
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