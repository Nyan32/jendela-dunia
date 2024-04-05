<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.5.1.3.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/main.css"); ?>">
    <link rel="icon" href="<?php echo base_url("assets/image/logo.ico") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/fontawesome-free-6.1.1-web/css/all.css") ?>">

    <script src="<?php echo base_url("assets/js/jquery.3.6.0.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.5.1.3.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jquery.fillcolor.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jquery-autotextcolor.js"); ?>"></script>
    <script>
        var base_url = '<?= base_url() ?>'
    </script>
    <script src="<?php echo base_url("assets/js/main_admin.js"); ?>"></script>

    <title>Jendela Dunia | Administrator</title>
</head>

<body class="d-flex flex-column" style="min-height:100vh">
    <header class="d-flex flex-wrap p-2 align-items-center color-1">
        <div class="col-12 col-lg-3 d-flex justify-content-lg-start justify-content-center color-1 p-2">ADMIN
        </div>
        <hr class="d-block d-lg-none col-12 m-0">
        <div class="col-12 col-lg-9">
            <nav id="navControl" class="h-100 overflow-hidden normal-nav">
                <ul class="list-group list-group-horizontal-lg align-items-center justify-content-lg-end justify-content-center">
                    <li class="list-group-item color-1 border-0"><button class="text-center style-1 color-1" id="booksBtn">BOOKS</button></li>
                    <li class="list-group-item color-1 border-0"><button class="text-center style-1 color-1" id="authorsBtn">AUTHORS</button></li>
                    <li class="list-group-item color-1 border-0"><button class="text-center style-1 color-1" id="publishersBtn">PUBLISHERS</button></li>
                    <li class="list-group-item color-1 border-0"><button class="text-center style-1 color-1" id="genresBtn">GENRES</button></li>
                    <li class="list-group-item color-1 border-0"><button class="text-center style-1 color-1" id="usersBtn">USERS</button></li>
                    <li class="list-group-item color-1 border-0">
                        <?php
                        if ($AdminLogin != null) {
                        ?>
                            <button class="text-center style-1 color-1" id="logoutBtn">LOGOUT</button>
                        <?php
                        } else {
                        ?>
                            <button class="text-center style-1 color-1" id="loginBtn">LOGIN</button>
                        <?php
                        }
                        ?>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-12 d-block d-lg-none">
            <button id="btnShowHideNav" class="style-1 color-1 w-100">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </header>
    <div class="flex-grow-1 d-flex flex-column">
        <?= $this->renderSection('body') ?>
    </div>
    <footer class="d-flex flex-wrap color-2 align-items-center">
        <div class="col-12 col-md-3 p-3 text-center">
            <img class="img-fluid" src="<?php echo base_url('assets/image/logo.png') ?>" alt="" style="max-height:100px" />
        </div>
        <div class="col-12 col-md-9 p-3 text-center">
            <h2 style="text-transform: uppercase;">ADMINISTRATOR</h2>
        </div>
        <div class="col-12 text-center" style="font-weight: bold; background-color: var(--color-7)">
            Oscar Deladas&copy; 2022
        </div>
    </footer>
</body>

</html>