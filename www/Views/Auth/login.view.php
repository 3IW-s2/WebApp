<main>
        <div class="container">
            <div class="div-center">
                <section id="course" class="course">
                <div class = "title text-center">
                    <h2 class = "position-relative d-inline-block"> login</h2> 
                </div>
                <div class="row">
                    <div class="course-col-4">
                    <form id="connection-form" method="post" action="" class="form1">
                            <?php   
                            if($error->hasErrors()): ?>
                            <div class="alert alert-danger">
                                <?php foreach($error->getErrors() as $errors): ?>
                                <p><?php echo $errors; ?></p>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="name">email</label>
                                <input type="email" name="email" id="email" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" />
                            </div>
                            <button style="margin-left: 31%;" type="submit" name="submit" class="btn btn-primary">Connect</button>
                            <div class = "title text-center" >
                                <?php
                                    //si l'utilisateur est connecté
                                    if(isset($_SESSION["user"])){
                                        echo "<a style='text-decoration: none; color:#e5345b;' href='logout'>Se déconnecter|</a>";
                                    }else{
                                        echo "<a style='text-decoration: none; color:#e5345b;' href='login'>Se connecter|</a>";
                                        echo "<a style='text-decoration: none; color:#e5345b;' href='register'>S'inscrire|</a>";
                                        echo "<a style='text-decoration: none; color:#e5345b;' href='forgotpassword'>Mots de passe oublié|</a>";
                                    }
                                ?>
                            </div>
                </form>
                    </div>
                </div>
                </section>
            </div>
        </div>
</main>
               

