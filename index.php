<?php session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
define("INDEX", ""); // УСТАНОВКА КОНСТАНТЫ ГЛАВНОГО КОНТРОЛЛЕРА
//define("DIRECTORY","/oop_kurs/"); //В какой паке проект, если в корне сервера, то просто /
define("DIRECTORY","/"); //В какой паке проект, если в корне сервера, то просто /
define("CONTROLLERS","controllers/"); //Путь к контроллерам
define("THEME","theme/"); //путь к теме
define("CONTROLLER_PATH",$_SERVER['DOCUMENT_ROOT'].DIRECTORY.CONTROLLERS); //Абсолюьтный путь сонтроллеров
define("THEME_PATH",$_SERVER['DOCUMENT_ROOT'].DIRECTORY.THEME); //Абсолютный путь темы
define("DIRECTORY_THEME",DIRECTORY.THEME); //Относительный путь темы
define("DEFAULT_CONTROLLER","home"); //Стандартная страница
define("EXT",".php"); //Расширение файлов
define("DEFAULT_TITLE","Библиотека"); //Стандартный тайтол

include (CONTROLLER_PATH."Controller".EXT); //Подключаем главный колнтроллер
include "controllers/View.php";
include "includes/JDB.php";
function object_to_array($data)
{
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}

// ГЛАВНЫЙ КОНТРОЛЛЕР
$page = new Controller();

if (isset($_GET['page'])){
    try {
        if (include(CONTROLLER_PATH . $_GET['page'] . EXT))
        {
            $class_name = "Controller_" . strtolower($_GET['page']);
            $page = new $class_name();
            $page->set_active($_GET['page']);

            if (isset($_GET['action'])) {
                $action = 'action_' . strtolower($_GET['action']);
                if (!method_exists($page, $action)) {
                    $page->action_404();
                } else
                    $page->$action();
            } else {
                $action = 'action_index';
                if (!method_exists($page, $action)) {
                    $page->action_404();
                } else
                    $page->$action();
            }
        }else {
            throw new Exception("Контроллер не найден");
        }
    }catch (Exception $ex){
        $page = new Controller();
        $page->action_404();
        var_dump($ex);
    }

}else{
    include(CONTROLLER_PATH.DEFAULT_CONTROLLER.EXT);
    $class_name = "Controller_".strtolower(DEFAULT_CONTROLLER);
    $page = new $class_name();
    $action = 'action_index';
    if (!method_exists($page, $action)) {
        $page->action_404();
    } else
        $page->$action();
}
$page->content;
$page = object_to_array($page);
if (!$page['title']) $page['title'] = DEFAULT_TITLE;

include (THEME_PATH."template.php");