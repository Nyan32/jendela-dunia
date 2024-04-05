<?= $this->extend('layout') ?>

<?= $this->section('body') ?>

<div id="errorNotif">
    <?php
    if ($errorRes != null) {
    ?>
        <ul class="alert-danger mb-0 p-2" id="errorList">
            <li><i class="fa-solid fa-circle-xmark"></i> <?= $errorRes ?></li>
        </ul>
    <?php
    }
    ?>
</div>

<br>

<div class="container align-self-center d-flex m-auto justify-content-center align-items-center position-relative w-100 h-100" style="max-width: 600px;">
    <div id="dummy"></div>
    <div class="w-100 position-absolute flex-column d-flex" id="loginForm">
        <form action="" class="w-100 h-100">
            <h2 class="p-2 text-center" style="color:var(--color-3)">LOGIN</h2>
            <?= csrf_field() ?>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="emailLogin">
                    <div class="p-2">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="text" name="emailLogin" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Email" id="emailLogin">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100  " for="passwordLogin">
                    <div class="p-2">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="passwordLogin" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Password" id="passwordLogin">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2 text-center">
                <button id="submitLogin" type="button" class="color-3 style-2" value="login">Submit</button>
            </div>
            <div class="p-2 d-flex justify-content-start align-items-center">
                <button type="button" class="style-1" style="background-color:transparent" id="registerBtn"> <i class="fa-solid fa-arrow-left"></i> Register</button>
            </div>
        </form>
    </div>

    <div class="w-100 position-absolute flex-column hidden" id="registerForm">
        <form action="" class="w-100 h-100">
            <h2 class="p-2 text-center" style="color:var(--color-3)">REGISTER</h2>
            <?= csrf_field() ?>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="name">
                    <div class="p-2">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" name="name" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Name" id="name">
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
                                <span class="select-label">Laki-laki</span>
                            </div>
                            <span><i class="fa-solid fa-sort"></i></span>
                        </label>
                    </div>
                    <div class="select-list position-absolute color-3 style-2 w-100 d-none">
                        <ul class="list-group">
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="M" class="w-100 h-100 p-2">
                                    <input type="radio" name="gender" id="M" value="M" checked hidden>
                                    <span class="item-label">Laki-laki</span>
                                </label>
                            </li>
                            <li class="list-group-item color-3 border-0 select-box-item p-0">
                                <label for="F" class="w-100 h-100 p-2">
                                    <input type="radio" name="gender" id="F" value="F" hidden><span class="item-label">Perempuan</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="birthdate">
                    <div class="p-2">
                        <i class="fa-solid fa-cake-candles"></i>
                    </div>
                    <input type="date" name="birthdate" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" id="birthdate">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="phone">
                    <div class="p-2">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <input type="tel" name="phone" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Phone" id="phone">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="address">
                    <div class="p-2">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <input type="text" name="address" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Address" id="address">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="emailReg">
                    <div class="p-2">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="text" name="emailReg" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Email" id="emailReg">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="passwordReg">
                    <div class="p-2">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="passwordReg" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Password" id="passwordReg">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="confPassword">
                    <div class="p-2">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="confPassword" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Confirm Password" id="confPassword">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2 text-center">
                <button id="submitRegister" type="button" class="color-3 style-2" value="register">Submit</button>
            </div>
            <div class="p-2 d-flex justify-content-end align-items-center">
                <button type="button" class="style-1" style="background-color:transparent" id="loginBtn">Login <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </form>
    </div>
</div>

<br>
<?= $this->endSection() ?>