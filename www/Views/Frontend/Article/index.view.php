</br>
<section id = "blogs" class = "py-5">
        <div class = "container">
            <div class = "title text-center py-5">
                <h2 class = "position-relative d-inline-block"><?= $articles['title'] ;?></h2>
            </div>

            <div class = "collection-list mt-5 row gx-0 gy-3">

                  
                  <div class = "col-md-6 ">
                      <div class="mb-2">
                        <div class = "card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                            <div class = "card-body px-0">
                                <h4 class = "card-title"><?= $articles['title'] ;?></h4>
                                <p class = "card-text mt-3 text-muted"><?= $articles['content'] ;?></p>
                                <!-- <p class = "card-text">
                                    <small class = "text-muted">
                                        <span class = "fw-bold">Author: </span><?= $articles['author'] ;?>
                                    </small>
                                </p> -->
                                <!--<a href = "#" class = "btn">Read More</a> -->
                            </div>
                      </div>
                  </div>

                  <!-- afficher tous les anciens commentaire et pouvoir en poster d'autres -->
                  <?php foreach  ($comments as $comment) :  ?>
                    <div class = "col-md-6 ">
                      <div class="mb-2">
                        <div class = "card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                            <div class = "card-body px-0">
                                <h4 class = "card-title"><?= $user ;?></h4>
                                <p class = "card-text mt-3 text-muted"><?= $comment['content'] ;?></p>
                                <!-- <p class = "card-text">
                                    <small class = "text-muted">
                                        <span class = "fw-bold">Author: </span><?= $articles['author'] ;?>
                                    </small>
                                </p> -->
                                <!--<a href = "#" class = "btn">Read More</a> -->
                            </div>
                       </div>
                      </div>
                     </div>

                    <?php endforeach; ?>

                  


            </div>
        </div>
    </section>