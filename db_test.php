<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 16.05.2017
 * Time: 13:02
 */
echo "PHP Inizilize";
include "includes/JDB.php";
$db = new JsonDB( "dbs/" );
//$db->createTable("main");
$db->insert("main",array('id'=>'a','name'=>'rim'));
$rez = $db->selectAll("main");
var_dump($rez);