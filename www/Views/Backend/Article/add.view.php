

<!-- un formulaire d'inscription -->


<main>
			<div class="container" style="width: 50%;">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block">Ajout d'un article</h2>
                            </div>
                                                            <!-- un formulaire d'inscription -->
                                                            <H1> </H1>
                                <form id="add-article-form" method="post" action="">
                                <?php if(isset($errors)): ?>
                                    <div class="alert alert-danger">
                                        <p><?php echo $errors; ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                                <label for="firstname">Titre</label>
                                                <input type="text" name="title" id="title" class="form-control"  />
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Contenu</label>
                                                <textarea name="content" id="editor"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Slug</label>
                                                <input type="text" name="slug" id="slug" class="form-control"  />
                                            </div>

                                            <div class="form-group">
                                                <label for="articleType">Type d'article</label>
                                                <select name="articleType" id="articleType" class="form-control">
                                                    <option value="">Sélectionnez un type d'article</option> <!-- Option vide par défaut -->
                                                    <?php foreach($articleTypes as $articleType): ?>
                                                        <option value="<?= $articleType['id'] ?>"><?= $articleType['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            
                                        
                                            <button type="submit" name="submit" class="btn btn-primary">Valider</button>
                                </form>

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>
