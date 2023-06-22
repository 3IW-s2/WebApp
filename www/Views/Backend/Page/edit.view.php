



   <!-- un formulaire d'inscription -->


<!-- un formulaire d'inscription -->


<main>
			<div class="container" style="width: 50%;">
                 <div class="div-center">
                    <section id="course" class="course">
                    
                        
                    <div class="row">
                        
                        <div class="course-col">
                        
                            <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block"> Editer  une page</h2>
                            </div>
                                <form id="add-page-form" method="post" action="">
                                    <div class="form-group">
                                                <label for="firstname">Title</label>
                                                <input type="text" name="title" id="title" class="form-control" value="<?= $posts["title"]?>" />
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Content</label>
                                                <textarea name="content" id="editor" ><?= $posts["content"] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">slug</label>
                                                <input type="text" name="slug" id="slug" class="form-control"  value="<?= $posts["slug"]?>" />
                                            </div>
                                        
                                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                </form>

        

                        </div>
                    

                    
                    
                    </div>

                    </section>
                </div>
			</div>
		</main>