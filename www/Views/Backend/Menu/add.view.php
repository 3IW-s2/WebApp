



   <!-- un formulaire d'inscription -->


<!-- un formulaire d'inscription -->


<main>
			<div class="container" style="width: 50%;">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block"> /h2>
                            </div>
                            <H1> ajouter un Lien dans le menu </H1>
                                <form id="add-menu-form" method="post" action="">
                                    <div class="form-group">
                                                <label for="firstname">Title</label>
                                                <input type="text" name="title" id="title" class="form-control"  />
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Url</label>
                                                <input type="text" name="url" id="url" class="form-control"   />
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                </form>

                                <H1> ajouter un sous menu </H1>
                                <!-- y'a plusieur valeurs dans $menus recupère les et mets les dans une liste dans mon form pour pouvoir les envoyers  -->

                                <form id="add-sous-menu-form" method="post" action="">
                                    <div class="form-group">
                                                <label for="firstname">Title</label>
                                                <input type="text" name="title" id="title" class="form-control"  />
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Url</label>
                                                <input type="text" name="url" id="url" class="form-control"   />
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Parent</label>
                                                <select name="parent_id" id="parent_id">
                                                    <?php foreach($menus as $menu): ?>
                                                        <option value="<?= $menu['menu_id'] ?>"><?= $menu['titre'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="submit-submenu" class="btn btn-primary">Register</button>
                                </form>

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>