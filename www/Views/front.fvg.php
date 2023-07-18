<?php

$frontRepository = new  App\Repositories\FrontRepository();
$front = $frontRepository->getFrontManagement();

$newFont = str_replace(' ', '+', $front['font']);

$appConfig = App\Core\Configuration\AppConfiguration::getAppConfig();

?>

<!DOCTYPE html>
<html>
<head>
        <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
        <script src="https://unpkg.com/grapesjs@0.21.2/dist/grapes.min.js"></script>
        <script src="https://unpkg.com/grapesjs-blocks-basic"></script>
        <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
        <script src="http://brokenlande.de/grapesjs/"></script>

    <meta charset="UTF-8">
    <title><?= $appConfig["APP_NAME"] ?? "Default app name" ?></title>
    <meta name="description" content="TIW">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "/public/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel = "stylesheet" href = "/public/css/main.css">
    <style>

        @import url('https://fonts.googleapis.com/css2?family=<?= $newFont ?>:wght@400;500;700&');

        :root {
            --font: '<?= $front['font'] ?>', sans-serif;
            --primary: <?= $front['primary_color'] ?>;
            --nv-color: <?= $front['nav_color'] ?>;
            --font-weight: <?= $front['font_weight'] ?>;
        }
        body {
            font-family: var(--font);
            font-weight: var(--font-weight);
        }

        a{
            text-decoration: none;
            color: var(--primary);
        }

        .navbar{
            background-color: var(--nv-color);
        }


    </style>

</head>
<body>
<nav class = "navbar navbar-expand-lg navbar-light py-4 fixed-top">
        <div class = "container">
            <a class = "navbar-brand d-flex justify-content-between align-items-center order-lg-0" href = "./">
<!--                  <img src = "../public/uploads/ --> <!--" style="height: 40px; width: 40px" alt="TIW">
 -->                 <!--  <img src = "images/Logo_EASYSCOOTER-removebg-preview.png" height="100%" alt = "site icon">
 -->                <span class = "text-uppercase fw-lighter ms-2">TIW</span>
            </a>

            <div class = "order-lg-2 nav-btns">
                <button onclick="window.location.href='/profile'" type = "button" class = "btn position-relative">
                    <i class = "fa fa-user" >      
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-light bg-dark" id="cart-container"></span>
                    </i>
                </button>
                <?php if(isset( $user_admin) && $user_admin == 1):?>
                
                    <button onclick="window.location.href='/admin'" type = "button" class = "btn position-relative">
                        <i class = "fa fa-cog" >      
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-light bg-dark" id="cart-container"></span>
                    
                        </i>
                    </button>
                <?php endif; ?>
            </div>
            

            <button class = "navbar-toggler border-0" type = "button" data-bs-toggle = "collapse" data-bs-target = "#navMenu">
                <span class = "navbar-toggler-icon"></span>
            </button>


            

            <div class="collapse navbar-collapse order-lg-1" id="navMenu">
            <ul class="navbar-nav mx-auto text-center">
                <!-- <li class="nav-item px-2 py-2">
                    <a class="nav-link text-uppercase text-dark" href="/">Home</a>
                </li> -->

                <?php
                foreach($menus as $menu){
                    // Vérifier si le menu a des sous-menus
                    $hasSubmenu = false;
                    foreach($sousmenus as $sousmenu){
                        if($sousmenu['parent_id'] == $menu['menu_id']){
                            $hasSubmenu = true;
                            break;
                        }
                    }

                    if($hasSubmenu){
                        // Menu avec sous-menus (utilisation d'un menu déroulant)
                        echo "<li class='nav-item px-2 py-2 dropdown'>";
                        echo "<a href='javascript:void(0)' class='nav-link text-uppercase text-dark dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>{$menu['titre']}</a>";
                        echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                        echo"<li><a class='dropdown-item' style='text-transform: uppercase;' href='{$menu['url']}'>{$menu['titre']}</a></li>";

                        foreach($sousmenus as $sousmenu){

                            if($sousmenu['parent_id'] == $menu['menu_id']){
                                //affiche le menu auquel il appartient et met le en majuscule et son lien aussi
                                echo "<li><a class='dropdown-item' href='{$sousmenu['url']}'>{$sousmenu['titre']}</a></li>";
                            }
                        }
                        
                        echo "</ul>";
                        echo "</li>";
                    } else {
                        // Menu sans sous-menus
                        echo "<li class='nav-item px-2 py-2'>";                                 
                        echo "<a class='nav-link text-uppercase text-dark' href='{$menu['url']}'>{$menu['titre']}</a>";
                        echo "</li>";
                    }
                }
                ?>
            </ul>
        </div>

        </div>
    </nav>
    

    <!-- inclure la vue -->
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php include $this->view; ?>
        </div>
    </div>
</div>

</body>

</html>