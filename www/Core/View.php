<?php
namespace App\Core;

use App\Repositories\FrontRepository;

class View {

    private String $view;
    private String $template;
    private $data = [];

    public function __construct(String $view, String $template = "back") {
        $this->setView($view);
        $this->setTemplate($template);

    }

    public function assign(String $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @param String $view
     */
    public function setView(string $view): void
    {
        $this->view = "Views/".$view.".view.php";
        if(!file_exists($this->view)){
            $this->view = "Views/".$view.".view.xml";
              if(!file_exists($this->view)){
                 die("La vue ".$this->view." n'existe pas");
                }
        }
    }

    public function setVariable (string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function getVariable (string $key)
    {
        return $this->data[$key];
    }

    /**
     * @param String $template
     */
    public function setTemplate(string $template): void
    {
        $this->template = "Views/".$template.".fvg.php";
        $frontRepository = new FrontRepository();
        $front = $frontRepository->getFrontManagement();
        if($template === "front"){
            if((int)$front['template'] === 0){
                if(!file_exists($this->template)){
                    die("Le template ".$this->template." n'existe pas");
                }
            }else{
                if( ((int)$front['template']) === 1){
                    $this->template = "Views/Template/".$template.".fvg.php";
                        if(!file_exists($this->template)){
                            die("Le template ".$this->template." n'existe pas");
                        }     
                }else{
                    $this->template = "Views/Template/".$template."-".(int)$front['template'].".fvg.php";
                        if(!file_exists($this->template)){
                            die("Le template ".$this->template." n'existe pas");
                        }

                 } 
            }
        }else{
            if(!file_exists($this->template)){
                die("Le template ".$this->template." n'existe pas");
            }
        }
    }

    public function __destruct(){
        extract($this->data);
        include $this->template;
    }


}