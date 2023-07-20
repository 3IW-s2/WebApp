<body>
    <h1>Template</h1>
    <p>il y'a <?= $nombreFichiers;?> template de préfait( pour en rajouter un  autre il faudra se mettre au html  ;)</p>

    <form action="" method="post">

         <input type="number" min="0"  max="<?=$nombreFichiers ?>" name="template" id="template">

   
         <button type="submit" name="submit" class="btn btn-primary">Valider</button>

    </form>

</body>
