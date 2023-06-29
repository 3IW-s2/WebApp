<?php
namespace App\Controllers;

use App\Core\View;


class ImageController
{
    
    public function uploadImage()
    {
        $view = new View("Backend/Image/index", "back");
        $view->assign("title", "Upload");

        if(isset($_POST['submit'])){
         $target_path = "public/uploads/";  
        $target_path = $target_path.basename( $_FILES['fileToUpload']['name']);   
        
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {  
           // echo "File uploaded successfully!";  
        } else{  
            echo "Sorry, file not uploaded, please try again!";  
        } 
        }
    }
}   