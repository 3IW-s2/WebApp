<form id="connection-form" method="post" action="" >
            <?php if($error->hasErrors()): ?>
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
            <button type="submit" name="submit" class="btn btn-primary">Connect</button>
</form>

        <?php
//si l'utilisateur est connecté
if(isset($_SESSION["user"])){
    echo "<a href='logout'>Se déconnecter</a>";
}else{
    echo "<a href='login'>Se connecter</a>";
    echo "<a href='register'>S'inscrire</a>";
    echo "<a href='forgotpassword'>Mots de passe oublié</a>";
}
?>        