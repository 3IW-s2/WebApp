<!-- un formulaire d'inscription -->
<h1>Modifier un utilisateur</h1>
<form id="update-register-form" method="post" action="" >
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
            <div class="form-group">
                <label for="pwd">Password</label>
                <input type="password" name="password" id="password" class="form-control"  />
            </div>
           
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
   </form>
