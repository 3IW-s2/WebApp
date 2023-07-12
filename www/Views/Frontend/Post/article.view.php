<section id="blogs" class="py-5">
    <div class="container">
       <!--  <div class="title text-center py-5">
        </div> -->

        <div class="collection-list mt-5 row gx-0 gy-3">

            <div class="col-md-12">
                <div class="mb-2">
                    <div class="card-body px-0">
                        <p class="card-text mt-3 text-muted"><?= $posts['content']; ?></p>
                    </div>
                </div>
            </div>

            <?php
            $currentPage = $_GET['page'] ?? 1; // Récupère la page courante depuis l'URL, ou utilise la page 1 par défaut
            $articlesPerPage = 4; // Nombre d'articles à afficher par page
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
                                        <span class="fw-bold">Author: </span><?= $article['author'] ?>
                                    </small>
                                </p>
                                <a href="<?= $url ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>


        </div>

    </div>
</section>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $currentPage - 1 ?>">Previous</a>
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
            <a class="page-link" href="?page=<?= $currentPage + 1 ?>">Next</a>
        </li>
    </ul>
</nav>

