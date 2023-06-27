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
                            <a href="user/add" class="btn btn-success">Add</a>

                            <thead>
                                <tr>
                                    <th scope="col">Id.</th>
                                    <th scope="col">Firstname</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                   <!--  <th scope="col">pasword</th> -->
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <th scope="row"><?= $user["id"] ?></th>
                                        <td><?= $user["firstname"]?></td>
                                        <td><?= $user["lastname"] ?></td>
                                        <td><?= $user["email"]?></td>
                                        <td><?= $user["role"] ?></td>
                                        <td><?= $user["status"] ?></td>
                                       <!--  <td></td> -->
                                        <td>
                                            <a href="user/edit?id=<?= $user['id'] ?>" class="btn btn-primary">Edit</a>
                                            <a href="user/delete?id=<?= $user['id'] ?>" class="btn btn-danger">Delete</a>
                                            <a href="user/role?id=<?= $user['id'] ?>" class="btn btn-info">Role</a>
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

   <!--  <dialog id="dialog">
        <form method="post" action="user/add">
            <input type="text" name="firstname" placeholder="firstname">
            <input type="text" name="lastname" placeholder="lastname">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="text" name="role" placeholder="role">
            <input type="submit" value="Add">
        </form>
        <button  onclick="document.getElementById('dialog').close()">Close</button>
    </dialog>

    <button onclick="document.getElementById('dialog').showModal()">Add</button> -->
  </body>
</html>