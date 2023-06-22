</br>
<section id = "blogs" class = "py-5">
        <div class = "container">
            <div class = "title text-center py-5">
                <h2 class = "position-relative d-inline-block"><?= $posts['title'] ;?></h2>
            </div>

            <div class = "collection-list mt-5 row gx-0 gy-3">

                  
                  <div class = "col-md-6 ">
                      <div class="mb-2">
                        <div class = "card border-0 col-md-6 col-lg-4 bg-transparent my-3">
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
                 
                  <?php //affiche $articles
                    foreach($articles as $article){
                        $url = "/article/{$article['slug']}";
                        echo "<div class = 'col-md-6 '>";
                            echo "<div class='mb-2'>";
                                echo "<div class = 'card border-0 col-md-6 col-lg-4 bg-transparent my-3'>";
                                    echo "<div class = 'card-body px-0'>";
                                        echo "<h4 class = 'card-title'>{$article['title']}</h4>";
                                        echo "<p class = 'card-text mt-3 text-muted'>{$article['content']}</p>";
                                        echo "<p class = 'card-text'>";
                                            echo "<small class = 'text-muted'>";
                                                echo "<span class = 'fw-bold'>Author: </span>{$article['author']}";
                                            echo "</small>";
                                        echo "</p>";
                                        echo "<a href = '$url' class = 'btn'>Read More</a>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                    ?>


                </div>


            </div>
        </div>
    </section>