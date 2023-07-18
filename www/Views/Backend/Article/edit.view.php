<!-- un formulaire d'inscription -->

<!-- un formulaire d'inscription -->


<main>
			<div class="container" style="width: 50%;">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block"> Modifier un Article</h2>
                            </div>
                                                            <!-- un formulaire d'inscription -->
                                <form id="update-register-form" method="post" action="" >
                                            <?php if(isset($errors)): ?>
                                                <div class="alert alert-danger">
                                                    <p><?php echo $errors; ?></p>
                                                </div>
                                                <?php endif; ?>
                                            <div class="form-group">
                                                <label for="firstname">Title</label>
                                                <input type="text" name="title" id="title" class="form-control" value="<?= $articles["title"]?>" />
                                            </div>                      
                                            <div class="form-group">
                                                <label for="lastname">Content</label>
                                                <textarea name="content" id="editor" ><?= $articles["content"] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">slug</label>
                                                <input type="text" name="slug" id="slug" class="form-control"  value="<?= $articles["slug"]?>" />
                                            </div>
                                            <div class="form-group">
                                                 <label for="active_comment"> active comment</label>
                                            </div>
                                            <input type="checkbox" name="active_comment" id="active_comment" <?php if ($articles["active_comment"] === "on") echo "checked"; ?>>

                                             <div class="form-group">
                                                <label for="articleType">articleType</label>
                                                <select name="articleType" id="articleType" class="form-control">
                                                    <option value="">Sélectionnez un type d'article</option> <!-- Option vide par défaut -->
                                                    <?php foreach($articleTypes as $articleType): ?>
                                                        <option value="<?= $articleType['id'] ?>" <?php if($articleType['id'] == $articles['category_id']) echo 'selected' ?>><?= $articleType['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                </form>

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>