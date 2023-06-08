<h2>Welco <?= $pseudo; ?> </h2>
<h3><?= $age?></h3>
<a href="/login" >Se connecter</a>
<a href="/register" >S'inscrire</a>
<?php 
    foreach($menus as $menu){
        echo "<a href='{$menu['url']}'>{$menu['titre']}</a>";
    }
?>