<?= $this->extend('layout') ?>

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

<div class="container align-self-center d-flex m-auto justify-content-center align-items-center w-100 h-100" style="max-width: 600px;">
    <div class="w-100 flex-column">
        <form action="editprofile" class="w-100 h-100" method="post">
            <h2 class="p-2 text-center" style="color:var(--color-3)">EDIT PROFILE</h2>
            <?= csrf_field() ?>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 " for="name">
                    <div class="p-2">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" name="name" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Name" id="name" value="<?= $userData[0]['name'] ?>">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <div class="select-box position-relative d-flex w-100">
                    <div class="color-3 flex-fill p-2 style-2 rounded-pill">
                        <label class="p-1 w-100 h-100 d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" class="select-activate" hidden>
                                <i class="fa-solid fa-venus-mars"></i>
                                <span class="select-label"><?php
                                                            if ($userData[0]['gender'] == 'M') {
                                                                echo 'Laki-laki';
                                                            } else {
                                                                echo 'Perempuan';
                                                            }
                                                            ?></span>
                            </div>
                            <span><i class="fa-solid fa-sort"></i></span>
                        </label>
                    </div>
                    <div class="select-list position-absolute color-3 style-2 w-100 d-none">
                        <ul class="list-group">
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="M" class="w-100 h-100 p-2">
                                    <input type="radio" name="gender" id="M" value="M" <?php
                                                                                        if ($userData[0]['gender'] == 'M') echo 'checked';
                                                                                        ?> hidden>
                                    <span class="item-label">Laki-laki</span>
                                </label>
                            </li>
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="F" class="w-100 h-100 p-2">
                                    <input type="radio" name="gender" id="F" value="F" <?php
                                                                                        if ($userData[0]['gender'] == 'F') echo 'checked';
                                                                                        ?> hidden>
                                    <span class="item-label">Perempuan</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 " for="birthdate">
                    <div class="p-2">
                        <i class="fa-solid fa-cake-candles"></i>
                    </div>
                    <input type="date" name="birthdate" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" id="birthdate" value="<?= $userData[0]['birthdate'] ?>">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 " for="phone">
                    <div class="p-2">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <input type="tel" name="phone" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Phone" id="phone" value="<?= $userData[0]['phone'] ?>">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 " for="address">
                    <div class="p-2">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <input type="text" name="address" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Address" id="address" value="<?= $userData[0]['address'] ?>">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 " for="emailReg">
                    <div class="p-2">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="text" name="emailReg" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Email" id="emailReg" value="<?= $userData[0]['email'] ?>">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 " for="passwordReg">
                    <div class="p-2">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="passwordReg" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Password" id="passwordReg" value="<?= $userData[0]['password'] ?>">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 " for="confPassword">
                    <div class="p-2">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="confPassword" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Confirm Password" id="confPassword">
                    <div class="p-2"></div>
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