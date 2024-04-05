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
    <div class="w-100 flex-column d-flex">
        <form action="" class="w-100 h-100" method="POST">
            <h2 class="p-2 text-center" style="color:var(--color-3)">LOGIN</h2>
            <?= csrf_field() ?>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100 " for="emailLogin">
                    <div class="p-2">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="text" name="emailLogin" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Email" id="emailLogin">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2">
                <label class="p-1 d-flex align-items-center rounded-pill border-1 color-3 style-2 w-100" for="passwordLogin">
                    <div class="p-2">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="passwordLogin" class="flex-grow-1 rounded-pill color-3 border-0" style="outline: none;" placeholder="Password" id="passwordLogin">
                    <div class="p-2"></div>
                </label>
            </div>
            <div class="p-2 text-center">
                <button type="submit" class="color-3 style-2" name="method" value="login">Submit</button>
            </div>
        </form>
    </div>
</div>

<br>

<?= $this->endSection() ?>