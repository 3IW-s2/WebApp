
   <main>
			<div class="container">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block"> Register</h2>
                            </div>
                                                            <!-- un formulaire d'inscription -->
                            <form id="register-form" method="post" action="" class="form1" >
                                        <?php 
                                         if($error->hasErrors()): ?>
<!--                                         <div class="alert alert-danger">
 -->                                            <?php foreach($error->getErrors() as $errors): ?>
                                                <?php if( $errors == "Un email de confirmation vous a été envoyé"): ?>
                                                    <div class="alert alert-success">
                                                    <p><?php echo $errors; ?></p>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="alert alert-danger">
                                                    <p><?php echo $errors; ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                     <!--    </div> -->
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <label for="firstname">Firstname</label>
                                            <input type="text" name="firstname" id="firstname" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Lastname</label>
                                            <input type="text" name="lastname" id="lastname" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="email">email</label>
                                            <input type="text" name="email" id="email" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" />
                                        </div>
                                    
                                        <button style="margin-left: 11%; width:280px; margin-top: 10px;" type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
                            </form>

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>