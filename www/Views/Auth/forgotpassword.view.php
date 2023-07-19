  

<main>
			<div class="container">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block">Veuiller saisir votre email pour renitialiser votre mot de passe</h2>
                            </div>
                           
                                                <!-- met un formulaire d'oublie de password -->
                            <form method="post" action="" >
                            <?php   
                            if($error->hasErrors()): ?>
                            <div class="alert alert-danger">
                                <?php foreach($error->getErrors() as $errors): ?>
                                <p><?php echo $errors; ?></p>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" name="email" id="email" class="form-control" />
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Valider</button>
                            </form> 
                      

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>