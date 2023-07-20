<section id="blogs" class="py-5">
    <div class="container">
       <!--  <div class="title text-center py-5">
        </div> -->

        <div class="collection-list mt-5 row gx-0 gy-3">

            <div class="col-md-12">
                <?= $posts['content'] ;?>
            </div>

            <?php 
                  if($posts['image_path'] == "on") : ?>
                    <?php
                        $currentPage = $_GET['page'] ?? 1; // Récupère la page courante depuis l'URL, ou on utilise la page 1 par défaut
                        $articlesPerPage = $admin_preferences; // Nombre d'articles à afficher par page
                        $startIndex = ($currentPage - 1) * $articlesPerPage;
                        $articlesToShow = array_slice($articles, $startIndex, $articlesPerPage);

                        foreach ($articlesToShow as $article) {
                            $article["content"] = substr($article["content"], 0, 20) . "...";
                            $url = "/article/{$article['slug']}";
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-2">
                                    <div class="card border-0 bg-transparent my-3">
                                        <div class="card-body px-0">
                                            <h4 class="card-title"><?= $article['title'] ?></h4>
                                            <p class="card-text mt-3 text-muted"><?= $article['content'] ?></p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <span class="fw-bold">Auteur : </span><?= $article['author'] ?>
                                                </small>
                                            </p>
                                            <a href="<?= $url ?>" class="btn btn-primary">Voir l'article</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                      <?php if(isset( $user_admin) && $user_admin == 1):?>
                          <form action="" method="post">
                              <label for="numberArticle">Nombre d'article par page</label>
                              <input type="number" name="numberArticle" id="numberArticle" min="1" value="<?= $admin_preferences ?>">
                              <input type="submit" value="Valider" name="number">
                          </form>
                      <?php endif; ?>

                  <?php endif ?>
                    <br><br><br><br><br>
                    <?php  if($posts['image_path'] == "on") : ?>
                        <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $currentPage - 1 ?>">Précédent</a>
                            </li>
                            <?php
                            $totalPages = ceil(count($articles) / $articlesPerPage);
                        
                            for ($i = 1; $i <= $totalPages; $i++) {
                                $activeClass = ($i == $currentPage) ? 'active' : '';
                                $pageUrl = '?page=' . $i;

                                echo "<li class='page-item $activeClass'><a class='page-link' href='$pageUrl'>$i</a></li>";
                            }
                            ?>
                            <li class="page-item <?= ($currentPage == $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $currentPage + 1 ?>">Suivant</a>
                            </li>
                        </ul>
                    </nav>

                    <?php endif ?>


        </div>

    </div>
</section>


<script>
   /*  var images = document.getElementsByTagName('img');
    for (var i = 0; i < images.length; i++) {
        images[i].style.width = '374px';
        images[i].style.height = '504px';
    }

    var images = document.getElementsByTagName('img');

    for (var i = 0; i < images.length; i++) {
        images[i].style.marginLeft = 'auto';
        images[i].style.marginRight = 'auto';
        images[i].style.display = 'block';
    } */
</script>