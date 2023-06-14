<H1> ajouter un article </H1>
<form id="add-article-form" method="post" action="">
    <div class="form-group">
                <label for="firstname">Title</label>
                <input type="text" name="title" id="title" class="form-control"  />
            </div>
            <div class="form-group">
                <label for="lastname">Content</label>
                <input type="text" name="content" id="content" class="form-control"   />
            </div>
            <div class="form-group">
                <label for="slug">slug</label>
                <input type="text" name="slug" id="slug" class="form-control"  />
            </div>
            <div class="form-group">
                <label for="password">image_path</label>
                <input type="file" name="image_path" id="image_path" class="form-control" accept="image/*"  />
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
   </form>