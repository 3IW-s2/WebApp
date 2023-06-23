<article>
    <h1><?= $article['title'] ?></h1>
    <p><?= $article['content'] ?></p>
    <p><?= $article['created_at'] ?></p>
</article>
<form action="/addComment?slug=<?= $article["slug"] ?>&&user_email=<?= $_SESSION["user"] ?>" method="post">
    <input type="text" name="content" id="content">
    <input type="submit" name="submit" class="btn btn-primary">
</form>
<?php foreach ($comments as $comment) : ?>
    <div>
        <p><?= $comment['user_id'] ?></p>
        <p><?= $comment["content"]?></p>
        <p><?= $comment["created_at"] ?></p>
        <a href="/signalcomment?id=<?= $comment['id'] ?>&&article_slug=<?= $article['slug'] ?>" class="btn btn-primary">Signaler</a>
    </div>
<?php endforeach; ?>

<?php if(isset($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
