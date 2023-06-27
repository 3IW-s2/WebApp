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
                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                        </form>
                        
                        <!-- Affichage de l'historique -->
                        <div class="form-group">
                            <label for="history">Historique</label>
                            <ul>
                                <?php foreach ($history as $entry): 
                                    $data = json_decode($entry["content"], true);
                                ?>
                                    <li>l'email: <?=$data["email"] ?></li>
                                    <li>le firstname: <?=$data["firstname"] ?></li>
                                    <li>le lastname: <?=$data["lastname"] ?></li>
                                    <form id="history-form" method="post" action="">
                                        <input type="hidden" name="id" value="<?= $data["id"] ?>" />
                                        <input type="hidden" name="email" value="<?= $data["email"] ?>" />
                                        <input type="hidden" name="firstname" value="<?= $data["firstname"] ?>" />
                                        <input type="hidden" name="lastname" value="<?= $data["lastname"] ?>" />
                                        <button type="submit" name="submit" class="btn btn-primary">Restore</button>
                                    </form>
                                    <br>_____<br>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- Fin de l'affichage de l'historique -->
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
