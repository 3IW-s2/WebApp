<section id="blogs" class="">
    <div class="container">
        <div class="title text-center py-5">
            <br><br>
            <h2 class="position-relative d-inline-block"><?= $articles['title'] ;?></h2>
        </div>

        <div class="collection-list mt-5 row justify-content-center gx-0 gy-3">

            <div class="col-md-6">
                <div class="mb-2">
                    <div class="card-body px-0">
                        <h4 class="card-title text-center"><?= $articles['title'] ;?></h4>
                        <p class="card-text mt-3 text-muted text-center"><?= $articles['content'] ;?></p>
                    </div>
                </div>
            </div>

            <section style="background-color: #eee;">
                <?php 
                if($comments === false) {
                    echo "Aucun commentaire pour cet article";
                } else {
                     foreach ($comments as $comment) : ?>
                        <div class="container comment-container my-3">
                            <div class="row justify-content-center">
                                <div class="col-md-12 col-lg-10 col-xl-8">
                                    <div class="card comment-card">
                                        <div class="card-body">
                                            <div class="d-flex flex-start align-items-center comment-header">
                                                <div>
                                                    <h6 class="fw-bold text-primary mb-1"><?=$comment['user']?></h6>
                                                    <p class="text-muted small mb-0"><?=$comment['created_at']?></p>
                                                </div>
                                            </div>
                    
                                            <p class="mt-2 mb-3"><?=$comment['content']?></p>
                    
                                            <form id="signal-comm" method="post" action="">
                                                <input type="hidden" name="id" value="<?=$comment['id']?>">
                                                <button type="submit" name="signaler" class="btn btn-primary">Signaler</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; 
                    
                } ?>

                <form id="add-comm" method="post" action="">
                    <div class="container my-5 py-5">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-10 col-xl-8">
                                <?php if(isset($errors)): ?>
                                    <div class="alert alert-danger">
                                        <?php foreach($errors as $error): ?>
                                            <p><?php echo $error; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="content">Commentaire</label>
                                    <input type="textarea" name="content" id="content" class="form-control" />
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary">Commentaire</button>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</section>
