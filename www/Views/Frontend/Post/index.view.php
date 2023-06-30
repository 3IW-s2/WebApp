</br>
<section id = "blogs" class = "py-5">
        <div class = "container">
            <div class = "title text-center py-5">
                <h2 class = "position-relative d-inline-block"><?= $posts['title'] ;?></h2>
            </div>

            <div class = "collection-list mt-5 row gx-0 gy-3">

                  
                  <div class = "col-md-14 ">
                      <div class="mb-2">
                        <div >
                            <div class = "card-body px-0">
                                <h4 class = "card-title"><?= $posts['title'] ;?></h4>
                                <p class = "card-text mt-3 text-muted"><?= $posts['content'] ;?></p>
                                <!-- <p class = "card-text">
                                    <small class = "text-muted">
                                        <span class = "fw-bold">Author: </span><?= $post['author'] ;?>
                                    </small>
                                </p> -->
                                <!--<a href = "#" class = "btn">Read More</a> -->
                            </div>
                      </div>
                  </div>
                


                </div>


            </div>
        </div>
    </section>