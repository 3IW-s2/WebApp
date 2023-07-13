

<!-- un formulaire d'inscription -->


<main>
			<div class="container" style="width: 50%;">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block">  ajouter un article</h2>
                            </div>
                                                            <!-- un formulaire d'inscription -->
                                                            <H1> </H1>
                                <form id="add-article-form" method="post" action="">
                                <?php if(isset($error)): ?>
                                    <div class="alert alert-danger">
                                        <p><?php echo $error; ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                                <label for="name">name</label>
                                                <input type="text" name="name" id="name" class="form-control"  />
                                            </div>
                                            
                                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                </form>

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>
