<?php
namespace App\Core;

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
            die("La vue ".$this->view." n'existe pas");
        }
    }

    /**
     * @param String $template
     */
    public function setTemplate(string $template): void
    {
        $this->template = "Views/".$template.".fvg.php";
        if(!file_exists($this->template)){
            die("Le template ".$this->template." n'existe pas");
        }
    }

    public function __destruct(){
        extract($this->data);
        include $this->template;
    }


}