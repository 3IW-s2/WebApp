<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    
<div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id.</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">id user</th>
                                    <th scope="col">id article</th>
                                    <th scope="col">status</th>
                                   <!--  <th scope="col">pasword</th> -->
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $comment) : ?>
                                    <tr>
                                        <th scope="row"><?= $comment["id"] ?></th>
                                        <td><?= $comment["content"]?></td>
                                        <td><?= $comment["user_id"] ?></td>
                                        <td><?= $comment["article_id"]?></td>
                                        <td><?= $comment["status"]?></td>
                                       <!--  <td></td> -->
                                        <td>
                                            <a href="delete?id=<?= $comment['id'] ?>" class="btn btn-danger">Delete</a>
                                            <?php if ($comment['status'] > 20) : ?>
                                                <a href="restore?id=<?= $comment['id'] ?>" class="btn btn-success">restore</a>
                                            <?php else: ?>
                                                <a href="remove?id=<?= $comment['id'] ?>" class="btn btn-warning">remove</a>
                                            <?php endif; ?>

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

    </body>
</html>
