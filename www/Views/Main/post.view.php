<article>
    <h1></h1>
    <p></p>
    <p></p>
    <p></p>
</article>
<form action="">
    <input type="text" name="content" id="content">
    <input type="submit" value="Envoyer" name="submit>
</form>
<?php foreach ($comments as $comment) : ?>
    <div>
        <p><?= $comment["user_id"] ?></p>
        <p><?= $comment["content"]?></p>
        <p><?= $comment["created_at"] ?></p>
        <a href="signal?id=<?= $comment['id'] ?>" class="btn btn-primary">Signaler</form>
    </div>
<?php endforeach; ?>