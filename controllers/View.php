<?php

/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 22.05.2017
 * Time: 19:12
 */
class View
{
    public static function factory($file, $varibles=null){
        $tmp = file_get_contents ("views/$file".EXT);
        if (is_array($varibles)){
            $searchez=array();
            $replaces=array();
            foreach ($varibles as $key=>$param){
                $searchez[]="$".$key."$";
                $replaces[]=$param;
            }
            $tmp = str_replace($searchez, $replaces, $tmp);
        }
        return $tmp;
    }

    public static function date_format($input, $hm = false, $hide_today=false){
        if ($input == '0000-00-00 00:00:00' || $input == '0000-00-00') return 'н/д';
        if ($input == null || strtolower($input) == "null") return null;
        if ($hide_today){
            if (date('d.m.Y')==date('d.m.Y',strtotime($input))){
                if ($hm){
                    return 'Сегодня '.date('H:i', strtotime($input));
                } else return 'Сегодня';
            } else {
                return strtotime($input) ? date("d.m.Y" . ($hm ? " H:i:s" : ""), strtotime($input)) : '-';
            }
        } else {
            return strtotime($input) ? date("d.m.Y" . ($hm ? " H:i:s" : ""), strtotime($input)) : '-';
        }
    }

    public static function interval($date1, $date2, $t='d', $withminus=false){
        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $interval = $datetime1->diff($datetime2);
        $ovdays = $interval->days;
        if ($withminus){
            if ($datetime1>$datetime2) $ovdays = $ovdays*(-1);
        }
        $months = $interval->m;
        $years = $interval->y;
        $hourse = $interval->h;
        $minuts = $interval->i;
        $secs = $interval->s;
        switch ($t){
            case 'd': return $ovdays; break; //Дни
            case 'm': return ($months + ($years*12)); break; //Месяцы
            case 'y': return $years; break; //Года
            case 'h': return $hourse; break;
            case 'i': return $minuts; break;
            case 's': return $secs; break;
            default: return $ovdays;
        }
    }

    public static function select_options($datas, $value, $text, $space=' ', $selected=null){
        $options = "";
        foreach ($datas as $data){
            if (isset($data[$value])){
                $txt = "";
                if ($text == "F:fio"){
                    $fio = "";
                    if (isset($data['lastname']) && $data['lastname'])
                        $fio .= $data['lastname'];
                    if (isset($data['firstname']) && $data['firstname'])
                        $fio .=' ' . substr($data['firstname'], 0, 2).'.';
                    if (isset($data['patronymic']) && $data['patronymic'])
                        $fio .=' ' . substr($data['patronymic'], 0, 2) . '.';
                    $txt =  $fio;
                }else {
                    if (is_array($text)) {
                        foreach ($text as $item) {
                            if (isset($data[$item]))
                                $txt .= $data[$item] . $space;
                        }
                    } else {
                        if (isset($data[$text]))
                            $txt = $data[$text];
                    }
                }
                if ($txt)
                    $options .="<option ".($selected==$data[$value]?'selected':'')." value='$data[$value]'>$txt</option>";
            }
        }
        return $options;
    }

    public static function select($name, $datas, $value, $text, $space=' '){
        $options = "<select id=\"$name\" name=\"$name\" class=\"form-control\">";
        foreach ($datas as $data){
            if (isset($data[$value])){
                $txt = "";
                if (is_array($text)){
                    foreach ($text as $item){
                        if (isset($data[$item]))
                            $txt .=$data[$item].$space;
                    }
                }else{
                    if (isset($data[$text]))
                        $txt = $data[$text];
                }
                if ($txt)
                    $options .="<option value='$data[$value]'>$txt</option>";
            }
        }
        $options .="</select>";
        return $options;
    }
}