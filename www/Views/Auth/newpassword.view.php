Reset ton mots de passe <?php echo $_SESSION['user']['email'] ?>
<form id="connection-form" method="post" action="" >
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" />
            </div>
    <button type="submit" name="submit" class="btn btn-primary">Send</button>
</form>