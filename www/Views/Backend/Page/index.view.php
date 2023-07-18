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
 
<!-- Button trigger modal -->


<!-- Modal -->


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
                                    <th scope="col">Auteur</th>
                                    <th scope="col">Contenu</th>
                                    <th scope="col">Modal</th>
                                    <th scope="col">Staut</th>
                                    <th scope="col">Catégorie</th>
                                    <th scope="col">slug</th>
                                   <!--  <th scope="col">pasword</th> -->
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posts as $post) :

                                        foreach($articleTypes as $type) :
                                            if($type["id"] == $post["category_id"]) :
                                                $post["category_id"] = $type["name"];
                                            endif;
                                        endforeach;
                                    ?>
                                    <div class="modal fade" id="exampleModal<?= $post["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Titre de la modal</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <?= $post["content"] ?>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <?php
                                    $post_content = substr($post["content"], 0, 100);
                                    $post['status'] = $post['status'] == 1 ? 'published' : 'pending';
                                     ?>
                                    <tr>
                                        <th scope="row"><?= $post["id"] ?></th>
                                        <td><?= $post["author"] ?></td>
                                        <td><?= $post_content ?></td>
                                        <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $post["id"] ?>">
                                           Tout afficher
                                        </button>
                                        </td>
                                        <td><?= $post["status"] ?></td>
                                        <td><?= $post["category_id"] ?></td>
                                        <td><?= $post["slug"]?></td>
                                       <!--  <td></td> -->
                                        <td>
                                            <a href="edit?id=<?= $post['id'] ?>" class="btn btn-primary">Modifier</a>
                                            <a href="delete?id=<?= $post['id'] ?>" class="btn btn-danger">Supprimer</a>
                                            <?php if($post['status'] == 'published') : ?>
                                                <a href="pending?id=<?= $post['id'] ?>" class="btn btn-warning">En attente</a>
                                            <?php else : ?>
                                                <a href="publish?id=<?= $post['id'] ?>" class="btn btn-success">Publier</a>
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

    <!-- <script>
        var images = document.images;
        var srcList = [];
        for(var i = 0; i < images.length; i++) {
            
            images[i].style.width = "10%";
            images[i].style.height = "10%";
        }
    </script> -->
</html>