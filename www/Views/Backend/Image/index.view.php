

<form  method="post" enctype="multipart/form-data">  
    Select File:  
    <input type="file" name="fileToUpload" accept="image/png, image/gif, image/jpeg"/>  
    <input type="submit" value="Upload Image" name="submit" />  
</form>  
<?php 
 //afficher toutes les images du dossier uploads avec leur lien
  $images = scandir("public/uploads/");
  foreach($images as $image){
      if($image != "." && $image != ".."){
        
        ?>

        <div class="div">
            <a href="/public/uploads/<?php echo $image ?>"  class="image_paste"><?php echo $image ?></a>
            <!-- copier l'image -->


        </div>
        <?php
      }
  }
 

?>
