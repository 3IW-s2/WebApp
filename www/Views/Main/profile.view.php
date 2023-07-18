
    <div class="container">
        
    </br></br></br></br></br></br></br></br>


     <div class="row">
           
           <div>
                <?php
                                  
                                    ?>
                                    <div>
                                       Firstname: <?= $user['firstname'] ?>
                                    </div>
                                    <div>
                                        Lastname  : <?= $user['lastname'] ?>
                                    </div> 
                                    <div>
                                        email : <?= $user['email'] ?>
                                     </div>
                                
                                    <?php
                                                 

                     
                ?>
              </div>
         
              
              
              <br><br> <br><br>
              <a href="/logout" > <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Se déconnecter
            </button></a>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                  <?php if($user['role'] != 1){
                  ?>
                <button type="submit" name="delete" class="btn btn-danger">Supprimer mon compte</button>
               <?php } ?>
              </form>
             
              </div>    
           </div>
           <div class="row">
           
           </div>
     </div>
    </div>
</body>
</html>
