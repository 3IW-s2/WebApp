<H1> ajouter un article </H1>
<form id="add-page-form" method="post" action="">
    <div class="form-group">
                <label for="firstname">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= $posts["title"]?>" />
            </div>
            <div class="form-group">
                <label for="lastname">Content</label>
                <input type="text" name="content" id="content" class="form-control"  value="<?= $posts["content"]?>" />
            </div>
            <div class="form-group">
                <label for="email">slug</label>
                <input type="text" name="slug" id="slug" class="form-control"  value="<?= $posts["slug"]?>" />
            </div>
           
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
   </form>