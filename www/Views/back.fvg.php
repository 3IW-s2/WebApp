  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="UTF-8">
      <title>Backend</title>
      <meta name="description" content="TIW">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
      <!-- bootstrap css -->
      <link rel = "stylesheet" href = "/public/bootstrap-5.0.2-dist/css/bootstrap.min.css">
      <!-- custom css -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      
      <script src="/public/ckeditor/ckeditor.js"></script>
        <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="/public/plugins/fontawesome-free/css/all.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="/public/dist/css/adminlte.min.css">

      <link rel="stylesheet" href="https://unpkg.com/grapesjs@0.21.2/dist/css/grapes.min.css">
      <script src="https://unpkg.com/grapesjs@0.21.2/dist/grapes.min.js"></script>
  


      

      <link rel="stylesheet" href="assets/css/pricing-plan.css">
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6721551398549890"
      crossorigin="anonymous"></script>
  </head>
  <body>

  <div class="wrapper">



    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Voir le site</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        
        <!-- Notifications Dropdown Menu -->
        
      
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class='fa-solid fa-person'></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
    

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
      

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
        
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  CRUD
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/showuser" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> show users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/article/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>show article</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/menu/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>show menu</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/page/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>show posts</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/comment/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>show comments</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="/admin/image/index" class="nav-link">
                <i class="nav-icon far fa-pic"></i>
                <p>
                  Dépots images
                </p>
              </a>
            </li>
            <li class="nav-item">
              <li class="nav-item">
                  <a href="/admin/front/edit" class="nav-link">
                      <i class="nav-icon far fa-edit"></i>
                      <p>
                          Modification du style du site
                      </p>
                  </a>
            </li>

            <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Tables
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/tables/simple.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Simple Tables</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/tables/data.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>DataTables</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/tables/jsgrid.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>jsGrid</p>
                  </a>
                </li>
              </ul>
            </li> -->
          </ul>
          
        </nav>
        
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

         
       
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li> -->
        </ul>
        
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active"><a href="/admin">Dashboard</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
        
            
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
          <?php include $this->view;?>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Main row -->
      
          <!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
  
  </div>
      <!-- inclure la vue -->
      
    

      <script src="/public/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/public/dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="/public/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="/public/plugins/raphael/raphael.min.js"></script>
  <script src="/public/plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="/public/plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="/public/plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="/public/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="/public/dist/js/pages/dashboard2.js"></script>
  </body>
  <script>
      function copyLink(event) {
          event.preventDefault(); // Empêche le comportement par défaut du lien

          var link = event.target.parentElement.href; // Récupère l'URL du lien parent
          navigator.clipboard.writeText(link) // Copie l'URL dans le presse-papiers
              .then(function() {
                  console.log('Lien copié avec succès : ' + link);
                  // Vous pouvez ajouter ici un message de succès ou effectuer d'autres actions
              })
              .catch(function(error) {
                  console.error('Erreur lors de la copie du lien : ', error);
                  // Vous pouvez gérer ici les erreurs de copie du lien
              });
      }
  </script>
  <script>
    CKEDITOR.replace('editor');
  
  </script>

  <style>
    .hidden-textarea{
      display:none;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['utilisateurs', 'Posts', 'comments', 'articles'],
        datasets: [{
          label: 'statistiques',
          data: [<?php echo count($users); ?>, <?php echo count($pages); ?>, <?php echo count($comments); ?>, <?php echo count($articles); ?>],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
  <script>
    setInterval(function() {
    var token = <?= json_encode(strtotime($_SESSION['expire_token'])) ?>;
    var now = Math.floor(Date.now() * 1000); // Obtient le timestamp actuel en secondes
    console.log(token);
    console.log(now);
    if (token < now) {
      window.location.href = "/logout";
    }
  }, 300000); // Exécute toutes les 5 minutes (300 000 millisecondes)


</script>

  </html>