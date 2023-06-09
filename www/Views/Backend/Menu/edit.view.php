<H1> ajouter un article </H1>
<form id="add-page-form" method="post" action="">
            <div class="form-group">
                <label for="email">parent_id</label>
                <input type="text" name="parent_id" id="parent_id" class="form-control"  value="<?= $menu["parent_id"]?>" />
            </div>
            <div class="form-group">
                <label for="firstname">Title</label>
                <input type="text" name="titre" id="titre" class="form-control" value="<?= $menu["titre"]?>" />
            </div>
            <div class="form-group">
                <label for="lastname">url</label>
                <input type="text" name="url" id="url" class="form-control"  value="<?= $menu["url"]?>" />
            </div>
      
           
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
   </form>