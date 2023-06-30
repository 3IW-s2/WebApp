
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
              deconnecter
            </button></a>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
              </form>
             
              </div>    
           </div>
           <div class="row">
           
           </div>
     </div>
    </div>
</body>
</html>
