<!-- un formulaire d'inscription -->

<!-- un formulaire d'inscription -->


<main>
			<div class="container" style="width: 50%;">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block">Modification d'un article</h2>
                            </div>
                                                            <!-- un formulaire d'inscription -->
                                <form id="update-register-form" method="post" action="" >
                                            <?php if(isset($errors)): ?>
                                                <div class="alert alert-danger">
                                                    <p><?php echo $errors; ?></p>
                                                </div>
                                                <?php endif; ?>
                                            <div class="form-group">
                                                <label for="firstname">Titre</label>
                                                <input type="text" name="title" id="title" class="form-control" value="<?= $articles["title"]?>" />
                                            </div>                      
                                            <div class="form-group">
                                                <label for="lastname">Contenu</label>
                                                <textarea name="content" id="editor" ><?= $articles["content"] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Slug</label>
                                                <input type="text" name="slug" id="slug" class="form-control"  value="<?= $articles["slug"]?>" />
                                            </div>
                                            <div class="form-group">
                                                 <label for="active_comment"> active comment</label>
                                            </div>
                                            <input type="checkbox" name="active_comment" id="active_comment" <?php if ($articles["active_comment"] === "on") echo "checked"; ?>>

                                             <div class="form-group">
                                                <label for="articleType">Type d'article</label>
                                                <select name="articleType" id="articleType" class="form-control">
                                                    <?php foreach($articleTypes as $articleType): ?>
                                                        <option value="<?= $articleType['id'] ?>" <?php if($articleType['id'] == $articles['category_id']) echo 'selected' ?>><?= $articleType['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary">Valider</button>
                                </form>

                                <div class="form-group">
                                <label for="history">Historique</label>
                                <ul>
                                 
                                    <?php foreach ($history as $entry): 
                                     $data = json_decode($entry["content"], true);
                                        ?>
                                    <div class="modal fade" id="exampleModal<?= $entry["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <?= $data["content"] ?>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                 
                                        <?php
                                        ?>         <br> _____<br>
                                         <li> le titre: <?=$data["title"] ?></li>   
                                        <li> le slug: <?=$data["slug"] ?></li>   
                                        <li> le status: <?=substr($data["content"], 0, 100) ?></li> 
                                        <form id="update-register-form" method="post" action="">
                                            <textarea id="content" name="content" class="hidden-textarea"><?= $data["content"] ?></textarea>
                                            <input type="hidden" name="title" value="<?= $data["title"] ?>" />
                                            <input type="hidden" name="slug" value="<?= $data["slug"] ?>" />
                                            <input type="hidden" name="update_at" value="<?= $data["update_at"] ?>" />
                                            <input type="hidden" name="articleType" value="<?= $data["articleType"] ?>" />
                                            <button type="submit" name="submit" class="btn btn-primary">Restore</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal<?= $entry["id"] ?>">
                                           tout voir
                                     </button>
                                    <?php endforeach; ?>
                                  
                                </ul>
                                </div>

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>