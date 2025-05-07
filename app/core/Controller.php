<?php 

Trait Controller 
{
    public function view($name, $data = []) 
    {
        extract($data);

        $path = "../app/views/".$name.".view.php";
        if (file_exists($path)) {
            require $path;
        } else {
            require "../app/views/404.view.php";
            die;
        }
    }
}