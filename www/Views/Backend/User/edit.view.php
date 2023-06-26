<!-- un formulaire d'inscription -->
<main>
    <div class="container" style="width: 50%;">
        <div class="div-center">
            <section id="course" class="course">
                <div class="row">
                    <div class="course-col">
                        <div class="title text-center">
                            <h2 class="position-relative d-inline-block">Modifier un utilisateur</h2>
                        </div>
                        <!-- un formulaire d'inscription -->
                        <form id="update-register-form" method="post" action="">
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $usr["firstname"]?>" />
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="lastname" id="lastname" class="form-control"  value="<?= $usr["lastname"]?>" />
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="text" name="email" id="email" class="form-control"  value="<?= $usr["email"]?>" />
                            </div>
                            <!-- Affichage de l'historique -->
                            <div class="form-group">
                                <label for="history">Historique</label>
                                <ul>
                                 
                                    <?php foreach ($history as $entry): 
                                     $data = json_decode($entry["content"], true);
                                        ?>          _____
                                        <li> l'email: <?=$data["email"] ?></li>
                                        <li> le firstname: <?=$data["firstname"] ?></li>
                                        <li> le lastname: <?=$data["lastname"] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!-- Fin de l'affichage de l'historique -->
                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
