<div class="row">
              <div class="container">
                  <?php
                  $apiKey = "3926c74ab3cd4a248777a19443a2658a";
                  $ips = $ip;

                  echo "<table class='table'>";
                  echo "<thead class='thead-dark'>";
                  echo "<tr>";
                  echo "<th>IP</th>";
                  echo "<th>Continent</th>";
                  echo "<th>Country</th>";
                  echo "<th>Organization</th>";
                  echo "<th>ISP</th>";
                  echo "<th>Languages</th>";
                  echo "<th>Is EU Member?</th>";
                  echo "<th>Currency</th>";
                  echo "<th>Timezone</th>";
                  echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";

                  foreach ($ips as $ip) {
                      $location = get_geolocation($apiKey, $ip['ip']);
                      $decodedLocation = json_decode($location, true);

                      echo "<tr>";
                      echo "<td>".$decodedLocation['ip']."</td>";
                      echo "<td>".$decodedLocation['continent_name']." (".$decodedLocation['continent_code'].")</td>";
                      echo "<td>".$decodedLocation['country_name']." (".$decodedLocation['country_code2'].")</td>";
                      echo "<td>".$decodedLocation['organization']."</td>";
                      echo "<td>".$decodedLocation['isp']."</td>";
                      echo "<td>".$decodedLocation['languages']."</td>";

                      if ($decodedLocation['is_eu'] == true) {
                          echo "<td>Yes</td>";
                      } else {
                          echo "<td>No</td>";
                      }

                      echo "<td>".$decodedLocation['currency']['name']."</td>";
                      echo "<td>".$decodedLocation['time_zone']['name']."</td>";
                      echo "</tr>";
                  }

                  echo "</tbody>";
                  echo "</table>";

                  function get_geolocation($apiKey, $ip, $lang = "en", $fields = "*", $excludes = "") {
                      $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip."&lang=".$lang."&fields=".$fields."&excludes=".$excludes;
                      $cURL = curl_init();

                      curl_setopt($cURL, CURLOPT_URL, $url);
                      curl_setopt($cURL, CURLOPT_HTTPGET, true);
                      curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
                      curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
                          'Content-Type: application/json',
                          'Accept: application/json',
                          'User-Agent: '.$_SERVER['HTTP_USER_AGENT']
                      ));

                      return curl_exec($cURL);
                  }
                  ?>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">tous les utilisateurs</span>
                <span class="info-box-number">
                  <?php 
                    echo count($users);
                   ?>
                  <small><?=  count($usersRemoved);?>Bloqué</small>
                  <small><?= count($userAct);?>actif</small>
                  <small><?=count($userPend);?>en attente</small>
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
                <span class="info-box-text">tous les articles</span>
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
                <span class="info-box-text">tous les commentaires</span>
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
                <span class="info-box-text"> tous Les pages</span>
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
                <span class="info-box-text"> tous Les utilisateurs en ligne</span>
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