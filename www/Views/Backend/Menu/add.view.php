<H1> ajouter un Lien dans le menu </H1>
<form id="add-menu-form" method="post" action="">
    <div class="form-group">
                <label for="firstname">Title</label>
                <input type="text" name="title" id="title" class="form-control"  />
            </div>
            <div class="form-group">
                <label for="lastname">Url</label>
                <input type="text" name="url" id="url" class="form-control"   />
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
</form>

<H1> ajouter un sous menu </H1>
<!-- y'a plusieur valeurs dans $menus recupère les et mets les dans une liste dans mon form pour pouvoir les envoyers  -->

<form id="add-menu-form" method="post" action="">
    <div class="form-group">
                <label for="firstname">Title</label>
                <input type="text" name="title" id="title" class="form-control"  />
            </div>
            <div class="form-group">
                <label for="lastname">Url</label>
                <input type="text" name="url" id="url" class="form-control"   />
            </div>
            <div class="form-group">
                <label for="lastname">Parent</label>
                <select name="parent_id" id="parent_id">
                    <?php foreach($menus as $menu): ?>
                        <option value="<?= $menu['menu_id'] ?>"><?= $menu['titre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="submit-submenu" class="btn btn-primary">Register</button>
</form>