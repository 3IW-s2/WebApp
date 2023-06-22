<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TIW</title>
    <meta name="description" content="TIW">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "/public/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    



    

    <link rel="stylesheet" href="assets/css/pricing-plan.css">
    <link rel = "stylesheet" href = "/public/css/main.css">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6721551398549890"
     crossorigin="anonymous"></script>
</head>
<body>
<nav class = "navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
        <div class = "container">
            <a class = "navbar-brand d-flex justify-content-between align-items-center order-lg-0" href = "./">
<!--                 <img src = "images/Logo_EASYSCOOTER-removebg-preview.png" height="100%" alt = "site icon">
 -->                <span class = "text-uppercase fw-lighter ms-2">TIW</span>
            </a>
            

            <div class = "order-lg-2 nav-btns">
                <button onclick="window.location.href='card.php'" type = "button" class = "btn position-relative">
                    <i class = "fa fa-user" >      
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-light bg-dark" id="cart-container"></span>
                
                    </i>
                </button>

     
            
              
            </div>
            

            <button class = "navbar-toggler border-0" type = "button" data-bs-toggle = "collapse" data-bs-target = "#navMenu">
                <span class = "navbar-toggler-icon"></span>
            </button>


            

            <div class = "collapse navbar-collapse order-lg-1" id = "navMenu">
                <ul class = "navbar-nav mx-auto text-center">

                         <?php 
                               
                                foreach($menus as $menu){
                                ?>
                                   <li class = "nav-item px-2 py-2">                                    
                                    <?php
                                    echo "<a class = 'nav-link text-uppercase text-dark'  href='/post{$menu['url']}'>{$menu['titre']}</a>";
                                    ?>
                                    </li>
                                
                                <?php
                                }
                            ?>
                    
                </ul>
            </div>
        </div>
    </nav>
    

    <!-- inclure la vue -->
    <?php include $this->view;?>

</body>
</html>