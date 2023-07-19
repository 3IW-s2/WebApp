<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $appConfig["APP_NAME"] ?? "Default app name" ?></title>
    <meta name="description" content="TIW">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/main.css">
    <style>
        :root {
            --primary: <?= $front['primary_color'] ?>;
            --nv-color: <?= $front['nav_color'] ?>;
            --font: '<?= $newFont ?>', sans-serif;
            --font-weight: <?= $front['font_weight'] ?>;
        }

        body {
            font-family: var(--font);
            font-weight: var(--font-weight);
        }

        a {
            text-decoration: none;
            color: var(--primary);
        }

        .navbar {
            background-color: var(--nv-color);
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .navbar-brand img {
            width: 30px;
        }

        .navbar-brand span {
            letter-spacing: 2px;
            font-family: var(--lg-font);
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .nav-item {
            border-bottom: 0.5px solid rgba(0, 0, 0, 0.05);
        }

        #header {
            background: url(../images/ducati-urban-e-mobility-trottinette-electrique-pro-i-evo-urbaanews.jpeg) top;
            background-repeat: contain;
            background-size: auto;
        }

        .carousel-inner h1 {
            font-size: 60px;
            font-family: var(--lg-font);
        }

        .carousel-item .btn {
            border-color: #fff !important;
        }

        .title h2::before {
            position: absolute;
            content: "";
            width: 4px;
            height: 50px;
            background-color: var(--primary);
            left: -20px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .active-filter-btn {
            background-color: var(--primary) !important;
            color: #fff !important;
            border-color: var(--primary) !important;
        }

        .filter-button-group .btn:hover {
            color: #fff !important;
        }

        .collection-img span {
            top: 20px;
            right: 20px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
        }

        .special-img span {
            top: 20px;
            right: 20px;
        }

        .special-list .btn {
            padding: 8px 20px !important;
        }

        .special-img img {
            -webkit-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .special-img:hover img {
            -webkit-transform: scale(1.2);
            -ms-transform: scale(1.2);
            transform: scale(1.2);
        }

        #offers {
            background: url(../images/offer_img.jpg) center/cover no-repeat;
        }

        #offers .row {
            min-height: 60vh;
        }

        .offers-content span {
            font-size: 28px;
        }

        .offers-content h2 {
            font-size: 60px;
            font-family: var(--lg-font);
        }

        .offers-content .btn {
            border-color: transparent !important;
        }

        #about {
            background-color: rgba(179, 179, 179, 0.05);
        }

        #newsletter {
            background-color: rgba(179, 179, 179, 0.05);
        }

        #newsletter p {
            max-width: 600px;
        }

        #newsletter .input-group {
            max-width: 500px;
        }

        #newsletter .form-control {
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }

        #newsletter .btn {
            background-color: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        #newsletter .btn:hover {
            background-color: #000;
            border-color: #000;
        }

        footer .brand {
            font-family: var(--lg-font);
            letter-spacing: 2px;
        }

        footer a {
            -webkit-transition: color 0.3s ease;
            -o-transition: color 0.3s ease;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: var(--primary) !important;
        }

        @media (min-width: 992px) {
            .nav-item {
                border-bottom: none;
            }
        }
    </style>
</head>
<body class="bg-yellow-200 text-gray-900">
<nav class="navbar navbar-expand-lg navbar-light py-4 fixed-top bg-blue-500">
    <div class="container mx-auto">
        <a class="navbar-brand flex justify-between items-center order-first" href="./">
            <span class="text-xl font-bold">TIW</span>
        </a>
        <div class="order-last nav-btns">
            <button onclick="window.location.href='/profile'" type="button" class="btn relative">
                <i class="fa fa-user"></i>
                <span class="absolute top-0 start-100 transform -translate-y-1/2 -translate-x-1/2 badge bg-dark" id="cart-container"></span>
            </button>
            <?php if (isset($user_admin) && $user_admin == 1) : ?>
                <button onclick="window.location.href='/admin'" type="button" class="btn relative">
                    <i class="fa fa-cog"></i>
                    <span class="absolute top-0 start-100 transform -translate-y-1/2 -translate-x-1/2 badge bg-dark" id="cart-container"></span>
                </button>
            <?php endif; ?>
        </div>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-2" id="navMenu">
            <ul class="navbar-nav mx-auto text-center">
                <?php foreach ($menus as $menu) : ?>
                    <?php
                    $hasSubmenu = false;
                    foreach ($sousmenus as $sousmenu) {
                        if ($sousmenu['parent_id'] == $menu['menu_id']) {
                            $hasSubmenu = true;
                            break;
                        }
                    }
                    if ($hasSubmenu) : ?>
                        <li class="nav-item px-2 py-2 dropdown">
                            <a href="javascript:void(0)" class="nav-link text-uppercase text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?= $menu['titre'] ?></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" style="text-transform: uppercase;" href="<?= $menu['url'] ?>"><?= $menu['titre'] ?></a></li>
                                <?php foreach ($sousmenus as $sousmenu) : ?>
                                    <?php if ($sousmenu['parent_id'] == $menu['menu_id']) : ?>
                                        <li><a class="dropdown-item" href="<?= $sousmenu['url'] ?>"><?= $sousmenu['titre'] ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item px-2 py-2">
                            <a class="nav-link text-uppercase text-white" href="<?= $menu['url'] ?>"><?= $menu['titre'] ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container mx-auto">
    <div class="row">
        <div class="col-md-12">
            <?php include $this->view; ?>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
