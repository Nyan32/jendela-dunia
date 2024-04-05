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
    <script src="<?php echo base_url("assets/js/main.js"); ?>"></script>

    <title>Jendela Dunia</title>
</head>

<body class="d-flex flex-column" style="min-height:100vh">
    <header class="d-flex flex-wrap p-2 align-items-center color-1">
        <div class="col-12 col-md-3 d-flex justify-content-md-start justify-content-center">
            <button class="style-1 color-1 h-100 p-2" id="homeBtn">
                <img src="<?php echo base_url("assets/image/logo.png") ?>" alt="logo" style="height: 50px">
            </button>
        </div>
        <hr class="d-block d-md-none col-12 m-0">
        <div class="col-12 col-md-9">
            <nav id="navControl" class="h-100 overflow-hidden normal-nav">
                <ul class="list-group list-group-horizontal-md align-items-center justify-content-md-end justify-content-center">
                    <li class="list-group-item color-1 border-0"><button class="text-center style-1 color-1" id="homeHeader">Home</button></li>
                    <li class="list-group-item color-1 border-0"><button class="text-center style-1 color-1" id="likesHeader">Likes</button></li>
                    <li class="list-group-item color-1 border-0"><button class="text-center style-1 color-1" id="aboutUsHeader">About Us</button></li>
                    <li class="list-group-item color-1 border-0">
                        <?php
                        if ($LoggedIn != null) {
                        ?>
                            <button class="text-center style-1 color-1" id="profileHeader">Profile</button>
                        <?php
                        } else {
                        ?>
                            <button class="text-center style-1 color-1" id="loginHeader">Login</button>
                        <?php
                        }
                        ?>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-12 d-block d-md-none">
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
        <div class="col-12 col-md-5 p-3 text-center">
            <h2 style="text-transform: uppercase;">Contact</h2>
            <ul class="list-group">
                <li class="list-group-item border-0 color-2"><i class="fa-brands fa-instagram"></i> oscardeladas</li>
                <li class="list-group-item border-0 color-2"><i class="fa-solid fa-envelope"></i> jendeladunia_22@gmail.com</li>
            </ul>
        </div>
        <div class="col-12 col-md-4 p-3 text-center">
            <h2 style="text-transform: uppercase;">Manage</h2>
            <ul class="list-group">
                <li class="list-group-item border-0 color-2"><button class="style-1 color-2" id="adminBtn">Administrator</button></li>
            </ul>
        </div>
        <div class="col-12 text-center" style="font-weight: bold; background-color: var(--color-7)">
            Oscar Deladas&copy; 2022
        </div>
    </footer>
</body>

</html>