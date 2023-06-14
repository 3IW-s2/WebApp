
<table class="table">
    <thead>
        <tr>
        <th scope="col">Utilisateur</th>
        <th scope="col">Commentaire</th>
        <th scope="col">Date de création</th>
        <th scope="col">Statut</th>
         <th scope="col">Nombre de signalement</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($comments as $comment) : ?>
        <tr>
            <td><?= $comment["user_id"] ?></th>
            <td><?= $comment["content"]?></td>
            <td><?= $comment["created_at"] ?></td>
            <td><?php echo !$comment["status"]  ? "Non autorisé" : "Autorisé"; ?></td>
            <td><?= $comment["signaled"] ?></td>
            <td><a href="edit?id=<?= $comment['id'] ?>" class="btn btn-primary">Edit</a> </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>




