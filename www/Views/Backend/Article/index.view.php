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
                            <a href="add" class="btn btn-success">Ajouter</a>

                            <thead>
                                <tr>
                                    <th scope="col">Id.</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Auteur</th>
                                    <th scope="col">Contenu</th>
                                    <th scope="col">Category_id</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Slug</th>
                                   <!--  <th scope="col">pasword</th> -->
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($articles as $article) : 
                                    $article["content"] = substr($article["content"], 0, 20);
                                    $article["status"] = ($article["status"] == 1) ? "Published" : "Pending";

                                       foreach($articleTypes as $type) :
                                            if($type["id"] == $article["category_id"]) :
                                                $article["category_id"] = $type["name"];
                                            endif;
                                        endforeach;
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $article["id"] ?></th>
                                        <td><?= $article["title"]?></td>
                                        <td><?= $article["author"] ?></td>
                                        <td><?= $article["content"]?></td>
                                        <td><?= $article["category_id"]?></td>
                                        <td><?= $article["status"] ?></td>
                                        <td><?= $article["slug"]?></td>
                                       <!--  <td></td> -->
                                        <td>
                                            <a href="edit?id=<?= $article['id'] ?>" class="btn btn-primary">Modifier</a>
                                            <a href="delete?id=<?= $article['id'] ?>" class="btn btn-danger">Supprimer</a>
                                           
                                            <?php if($article["status"] == "Published") : ?>
                                                <a href="pending?id=<?= $article['id'] ?>" class="btn btn-warning">En attente</a>
                                            <?php else : ?>
                                                <a href="publish?id=<?= $article['id'] ?>" class="btn btn-success">Publier</a>
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