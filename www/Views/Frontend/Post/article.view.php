<section id="blogs" class="py-5">
    <div class="container">
       <!--  <div class="title text-center py-5">
        </div> -->

        <div class="collection-list mt-5 row gx-0 gy-3">

            <div class="col-md-12">
                <div class="mb-2">
                    <div class="card-body px-0">
                        <p class="card-text mt-3 text-muted"><?= $posts['content'] ;?></p>
                    </div>
                </div>
            </div>

            <?php //affiche $articles
            foreach($articles as $article){
                $article["content"] = substr($article["content"], 0, 20) . "...";
                $url = "/article/{$article['slug']}";
                echo "<div class='col-md-6 col-lg-4'>";
                    echo "<div class='mb-2'>";
                        echo "<div class='card border-0 bg-transparent my-3'>";
                            echo "<div class='card-body px-0'>";
                                echo "<h4 class='card-title'>{$article['title']}</h4>";
                                echo "<p class='card-text mt-3 text-muted'>{$article['content']}</p>";
                                echo "<p class='card-text'>";
                                    echo "<small class='text-muted'>";
                                        echo "<span class='fw-bold'>Author: </span>{$article['author']}";
                                    echo "</small>";
                                echo "</p>";
                                echo "<a href='$url' class='btn'>Read More</a>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            ?>

        </div>

    </div>
</section>

<script>
 var images = document.images;
        var srcList = [];
        for(var i = 0; i < images.length; i++) {
            
            images[i].style.width = "10%";
            images[i].style.height = "10%";
        }

</script>