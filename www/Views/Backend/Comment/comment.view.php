
<table class="table">
    <thead>
        <tr>
        <th scope="col">Utilisateur</th>
        <th scope="col">Commentaire</th>
        <th scope="col">Date de création</th>
        <th scope="col">Statut</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($comments as $comment) : ?>
        <tr>
            <th scope="row"><?= $comment["user_id"] ?></th>
            <td><?= $comment["content"]?></td>
            <td><?= $comment["created_at"] ?></td>
            <td><?= $comment["status"]?></td>
        </tr>
    </tbody>
</table>

<label for="status">Autorisation du commentaire</label>

<select name="status" id="status">
    <option value="">--Please choose an option--</option>
    <option value="true">Autorisé</option>
    <option value="false">Non autorisé</option>
</select>
<?php endforeach; ?>