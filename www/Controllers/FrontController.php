<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Front;
use App\Repositories\FrontRepository;
use App\Core\Error;


class FrontController
{

    public function __construct()
    {
    }


    public function updateFront()
    {
        $fontRepository = new FrontRepository();
        $front = $fontRepository->getFrontManagement();
        $view = new View("Backend/Front/edit", "back");
        $view->assign("front", $front);

        if(isset($_POST['submit']))
        {
            $error = new Error();

            $fontRepository = new FrontRepository();
            $front = new Front();
            $Oldfront = $fontRepository->getFrontManagement();

            $front->setFont($_POST['font']);
            $front->setFontWeight($_POST['font_weight']);
            $front->setPrimaryColor($_POST['primary_color']);
            $front->setNavColor($_POST['nav_color']);
            $_FILES['logo']['size'] > 0 ? $front->setLogo($_FILES['logo']['name']) : $front->setLogo($Oldfront['logo']);
            $front->setId($_POST['id']);

            if(isset($_FILES['logo']) && $_FILES['logo']['size'] > 0)
            {

                $tmpName = $_FILES['logo']['tmp_name'];
                $name = $_FILES['logo']['name'];
                $size = $_FILES['logo']['size'];
                $error = $_FILES['logo']['error'];

                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));

                $extensions = ['jpg', 'png', 'jpeg'];
                $maxSize = 2000000;

                if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                    move_uploaded_file($tmpName, './public/uploads/'.$name);
                }
                else{
                    $error->addError("Le fichier n'est pas valide");
                }
            }

            $value = $fontRepository->updateFrontManagement($front);

            //check if error or success
            if($error->getErrors() != null)
            {
                $view->assign("error", $error->getErrors());
            }
            else
            {
                $success = "Front modifié avec succès";
                $view->assign("success", $success);
            }

        }

    }
}