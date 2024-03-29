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
                                    <th scope="col">parent_id</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Statut</th>
                                   <!--  <th scope="col">pasword</th> -->
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($menus as $menu) :
                                        $menu["status"] = ($menu["status"] == 1) ? "published" : "pending";
                                        //n'affiche pas le premier charactère de la chaine $menu['url']
                                        $menu["url"] = substr($menu["url"], 1);
                                        foreach($subMenu as $sub) :
                                            if($sub["menu_id"] == $menu["parent_id"]) :
                                                $menu["parent_id"] = $sub["titre"];
                                            endif;
                                        endforeach;
                                     ?>
                                    <tr>
                                        <th scope="row"><?= $menu["menu_id"] ?></th>
                                        <td><?= $menu["parent_id"]?></td>
                                        <td><?= $menu["titre"] ?></td>
                                        
                                        <td><?= $menu["url"]?></td>
                                        <td><?= $menu["status"]?></td>
                                       <!--  <td></td> -->
                                        <td>
                                            <a href="edit?id=<?= $menu['menu_id'] ?>" class="btn btn-primary">Modifier</a>

                                            <a href="delete?id=<?= $menu['menu_id'] ?>" class="btn btn-danger">Supprimer</a>
                                            <?php if ($menu["status"] == "published") : ?>
                                                <a href="pending?id=<?= $menu['menu_id'] ?>" class="btn btn-warning">En attente</a>
                                            <?php else : ?>
                                                <a href="publish?id=<?= $menu['menu_id'] ?>" class="btn btn-success">Publier</a>
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