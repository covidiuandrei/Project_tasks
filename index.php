<?php 
include_once("System/Config.php");
    
include_once("System/Model.php");
include_once("System/Controller.php");

$current_url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . strtok($_SERVER["REQUEST_URI"],'?');
$params     = split("/", trim(str_replace($config['site_url'], '', $current_url),'/'));
if ($params && count($params)>0 && $params[0]) {
    $controller_name = ucfirst($params[0]);
} else {
    $controller_name = $config['default_controller'];
}
    include_once('Controllers/'.  $controller_name.'.php');
    $controller = new $controller_name();
    if (isset($params[1])) {
        if (isset($params[2])) {
            if (isset($params[3])) {
                $controller -> {$params[1]}($params[2],$params[3]);
            } else {
                $controller -> {$params[1]}($params[2]);
            }
        }else {
            $controller -> {$params[1]}();
        }
    } else {
        $controller ->index();
    }
