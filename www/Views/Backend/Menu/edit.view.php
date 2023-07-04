





   <!-- un formulaire d'inscription -->


<!-- un formulaire d'inscription -->


<main>
			<div class="container" style="width: 50%;">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block"> editer le menu</h2>
                            </div>
                            <form id="add-page-form" method="post" action="">
                            <?php if(isset($error)): ?>
                                    <div class="alert alert-danger">
                                        <p><?php echo $error; ?></p>
                                    </div>
                                    <?php endif; ?>
                                        <div class="form-group">
                                            <label for="email">parent_id</label>
                                            <input type="text" name="parent_id" id="parent_id" class="form-control"  value="<?= $menu["parent_id"]?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="firstname">Title</label>
                                            <input type="text" name="titre" id="titre" class="form-control" value="<?= $menu["titre"]?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">url</label>
                                            <input type="text" name="url" id="url" class="form-control"  value="<?= $menu["url"]?>" />
                                        </div>
                                
                                    
                                        <button type="submit" name="submit" class="btn btn-primary">Register</button>
                            </form>
                                

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>