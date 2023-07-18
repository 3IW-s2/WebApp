<div class="row">

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Utilisateurs</span>
                <span class="info-box-number">
                  <?php 
                    echo count($users);
                   ?>
                  <small><?=  count($usersRemoved);?> Bloqué</small>
                  <small><?= count($userAct);?> Actif</small>
                  <small><?=count($userPend);?> En attente</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Articles</span>
                <span class="info-box-number"><?php echo count($articles); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-comments"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Commentaires</span>
                <span class="info-box-number"><?php echo count($comments); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pages</span>
                <span class="info-box-number"><?php echo count($pages) ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Utilisateurs en ligne</span>
                <span class="info-box-number"><?php echo count($userOnline) ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                  <div style="width:90%">
                    <canvas id="myChart2"></canvas>
                  </div>

              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        <div style="width:90%; height:50%">
             <canvas id="myChart"></canvas>
        </div>

      
           
        
</div>
