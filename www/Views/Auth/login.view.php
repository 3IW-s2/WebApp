<form id="connection-form" method="post" action="" >
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" id="name" class="form-control" />
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
}
?>        