<?php

/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 22.05.2017
 * Time: 14:39
 */
class Controller
{
    var $title = "";
    var $styles = "";
    var $scripts = "";
    var $content = "";
    var $active = array();

    public function set_content($content){
        $this->content = $content;
    }

    public function set_varibles($varibles){
        if (is_array($varibles)){
            $searchez=array();
            $replaces=array();
            foreach ($varibles as $key=>$param){
                $searchez[]="$".$key."$";
                $replaces[]=$param;
            }
            $this->content = str_replace($searchez, $replaces, $this->content);
        }
    }

    public function set_title($title){
        $this->title = $title." :: ".DEFAULT_TITLE;
    }

    public function add_script($src=null, $text=null, $type="text/javascript"){
        $this->scripts .="<script".($src?" src=\"$src\" ":"").($type?" type=\"$type\" ":"").">$text</script>";
    }

    public function add_link($href, $rel="stylesheet", $type="text/css"){
        $this->styles .= "<link rel=\"$rel\" type=\"$type\" href=\"$href\">";
    }

    public function add_style($text, $type="text/css"){
        $this->styles .= "<style type='$type'>$text</style>";
    }

    public function set_active($active){
        if (is_array($active)){
            $this->active = array();
            foreach ($active as $item){
                $this->active[$item] = "active";
            }
        }else {
            $this->active = array($active => "active");
        }
    }

    public function add_active($active){
        if (is_array($active)){
            foreach ($active as $item){
                $this->active[$item] = "active";
            }
        }else {
            $this->active[$active] = "active";
        }
    }

    public function action_404(){
        $this->set_active('nothing');
        $this->content = "
        <div class=\"col-md-12\">
			
			<div class=\"error-container\">
				<h1>Оу!</h1>
				
				<h2>404 Страница не найдена</h2>
				
				<div class=\"error-details\">
					Извиняйте, но такой страницы нет.
					
				</div> <!-- /error-details -->
				
				<div class=\"error-actions\">
					<a href=\"".DIRECTORY."\" class=\"btn btn-primary btn-lg\">
						<i class=\"icon-chevron-left\"></i>
						&nbsp;
						На главную страницу					
					</a>
					
				</div> <!-- /error-actions -->
							
			</div> <!-- /error-container -->			
			
		</div> <!-- /span12 -->
        ";
    }

    public function post($keys){
        if (is_array($keys)){
            $data = array();
            foreach ($keys as $key){
                if (isset($_POST[$key])) {
                    $data[$key] = $_POST[$key];
                }else{
                    $data[$key] = null;
                }
            }
            return $data;
        }else {
            if (isset($_POST[$keys])) {
                return $_POST[$keys];
            } else {
                return null;
            }
        }
    }

    public function get($keys){
        if (is_array($keys)){
            $data = array();
            foreach ($keys as $key){
                if (isset($_GET[$key])) {
                    $data[$key] = $_GET[$key];
                }else{
                    $data[$key] = null;
                }
            }
            return $data;
        }else {
            if (isset($_GET[$keys])) {
                return $_GET[$keys];
            } else {
                return null;
            }
        }
    }

    public function redirect($path){
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=$path\">";
    }

    public function is_post(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            return true;
        else return false;
    }

    public function shortfio($people){
        $fio = "";
        if (isset($people['lastname']) && $people['lastname'])
            $fio .= $people['lastname'];
        if (isset($people['firstname']) && $people['firstname'])
            $fio .=' ' . substr($people['firstname'], 0, 2).'.';
        if (isset($people['patronymic']) && $people['patronymic'])
            $fio .=' ' . substr($people['patronymic'], 0, 2) . '.';
        return $fio;
    }

}