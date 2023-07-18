<!-- un formulaire d'inscription -->

<!-- un formulaire d'inscription -->


<main>
			<div class="container" style="width: 50%;">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block">Modification de l'article</h2>
                            </div>
                                                            <!-- un formulaire d'inscription -->
                                <form id="update-register-form" method="post" action="" >
                                            <?php if(isset($error)): ?>
                                                <div class="alert alert-danger">
                                                    <p><?php echo $error; ?></p>
                                                </div>
                                                <?php endif; ?>
                                            <div class="form-group">
                                                <label for="firstname">Nom</label>
                                                <input type="text" name="name" id="name" class="form-control" value="<?= $articleType["name"]?>" />
                                            </div>                      
                                          
                                        
                                            <button type="submit" name="submit" class="btn btn-primary">Valider</button>
                                </form>

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>