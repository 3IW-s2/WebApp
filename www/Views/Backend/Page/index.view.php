<h1>Create your page</h1>
<div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table class="table">
                            <a href="post/add" class="btn btn-success">Add</a>

                            <thead>
                                <tr>
                                    <th scope="col">Id.</th>
                                    <th scope="col">title</th>
                                    <th scope="col">author</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                   <!--  <th scope="col">pasword</th> -->
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posts as $post) : ?>
                                    <tr>
                                        <th scope="row"><?= $post["id"] ?></th>
                                        <td><?= $post["title"]?></td>
                                        <td><?= $post["author"] ?></td>
                                        <td><?= $post["content"]?></td>
                                        <td><?= $post["status"] ?></td>
                                       <!--  <td></td> -->
                                        <td>
                                            <a href="post/edit?id=<?= $post['id'] ?>" class="btn btn-primary">Edit</a>
                                            <a href="post/delete?id=<?= $post['id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="col-md-2"></div>

                </div>
            </div>
        </div>
    </div>