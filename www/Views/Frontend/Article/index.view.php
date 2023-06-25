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

                  <section style="background-color: #eee;">
                  <?php foreach  ($comments as $comment) :  ?>
                            <div class="container my-5 py-5">
                                <div class="row d-flex justify-content-center">
                                <div class="col-md-12 col-lg-10 col-xl-8">
                                    <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-start align-items-center">
                                        <!-- <img class="rounded-circle shadow-1-strong me-3"
                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                                            height="60" /> -->
                                        <div>
                                            <h6 class="fw-bold text-primary mb-1"> <?=$user ?></h6>
                                            <p class="text-muted small mb-0">
                                            <?= $comment['created_at'] ;?>
                                            </p>
                                        </div>
                                        </div>

                                        <p class="mt-3 mb-4 pb-2">
                                        <?= $comment['content'] ;?>
                                        </p>

                                        </div>

                                        <form id="signal-comm" method="post" action="">
                                            <input type="hidden" name="id" value="<?=$comment['id']?>">
                                            <button type="submit" name="signaler" class=" btn-primary">Signaler</button>
                                        </form>
                                    </div>
                                    
                                   

                                    </div>
                                    <?php endforeach; ?>
                                    <form id="add-comm" method="post" action="">
                                    <div class="form-group">
                                       <?php  if(isset($errors)):  ?>
                                            <div class="alert alert-danger">
                                                <?php foreach($errors as $error): ?>
                                                <p><?php echo $error; ?></p>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php endif; ?>
                                        
                                                <label for="content">Commentaire</label>
                                                <input type="textarea" name="content" id="content" class="form-control"  />
                                            </div>
                                          
                                            <button type="submit" name="submit" class="btn btn-primary">Commnentaire</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                    </section>



                  


            </div>
        </div>
    </section>