<?php 

class App 
{
    private $controller = "NewsController";
    private $method = "index";

    private function urlSplit()
    {
        $url = $_GET['url'] ?? "news";
        return explode("/", rtrim($url, "/"));
    }

    public function loadController()
    {
        $url = $this->urlSplit();

        $this->controller = ucfirst($url[0])."Controller";
        $this->method = !empty($url[1]) ? $url[1] : "index";

        $path = "../app/controllers/".$this->controller.".php";
        if (file_exists($path)) {
            require $path;
            $controller = new $this->controller;
            if (method_exists($controller, $this->method)) {
                unset($url[0]);
                unset($url[1]);
                call_user_func_array([$controller, $this->method], $url);
            } else {
                require "../app/controllers/_404.php";
                return false; 
            }
        } else {
            require "../app/controllers/_404.php";
            return false;
        } 
    }
}