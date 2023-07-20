



   <!-- un formulaire d'inscription -->


<!-- un formulaire d'inscription -->


<main>
			<div class="container" style="width: 50%;">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block">Ajout d'un menu</h2>
                             <i><p>Il est possible d'ajouter un sous-menu lorsqu'un menu est créer et publier</p></i>
                            </div>
                            <H1>Ajout d'un lien dans le menu</H1>
                                <form id="add-menu-form" method="post" action="">
                                <?php if(isset($errors)): ?>
                                    <div class="alert alert-danger">
                                        <p><?php echo $errors; ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                                <label for="firstname">Titre</label>
                                                <input type="text" name="title" id="title" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Url</label>
                                                <input type="text" name="url" id="url" class="form-control">
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary">Valider</button>
                                </form>

                            <?php
                            if(!empty($menus)){ ?>

                                <H1>Ajout d'un sous menu</H1>
                                <!-- y'a plusieur valeurs dans $menus recupère les et mets les dans une liste dans mon form pour pouvoir les envoyers  -->

                                <form id="add-sous-menu-form" method="post" action="">
                                <?php if(isset($error)): ?>
                                    <div class="alert alert-danger">
                                        <p><?php echo $error; ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                                <label for="firstname">Titre</label>
                                                <input type="text" name="title" id="title" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Url</label>
                                                <input type="text" name="url" id="url" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Parent</label>
                                                <select name="parent_id" id="parent_id">
                                                    <?php  foreach($menus as $menu): ?>
                                                        <option value="<?= $menu['menu_id'] ?>"><?= $menu['titre'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="submit-submenu" class="btn btn-primary">Valider</button>
                                </form>

                            <?php } ?>

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>