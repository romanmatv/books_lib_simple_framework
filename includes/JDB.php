<?php defined('INDEX') OR die('Прямой доступ к странице запрещён!');
/*
 * Created by PhpStorm.
 * User: Roman
 * Date: 16.05.2017
 * Time: 13:10

	Пример:

		$db = new JsonDB( "папка_с_JSON_файлами/" );
		$result = $db -> select( "имя_таблицы(json)_без_разширения", "ключ_поиска", "слово_поиска" );
			
			Пример джейсона
				[
					{"ID": "0", "Name": "Вася Пупкин", "Age": "12"},
					{"ID": "1", "Name": "Василиса Тарантайкина", "Age": "16"},
					{"ID": "2", "Name": "Котана Рей", "Age": "14"}
				]
		
		Обзор функций:
		
			new JsonDB("папка_с_JSON_файлами/");
			JsonDB -> createTable("имя_таблицы");
			JsonDB -> select ( "table", "key", "value" ) - Выборка по ключу/значению, возвращаемая как массив
			JsonDB -> selectAll ( "table" )  - Выборка всей таблицы
			JsonDB -> update ( "table", "key", "value", ARRAY ) - Замена значений, у которых совпадает ключ/значение
			JsonDB -> updateAll ( "table", ARRAY ) - Замена всех значений
			JsonDB -> insert ( "table", ARRAY , $create = FALSE) - Вставка значений в таблицу. Если create, то таблица будет создана если ее нет
			JsonDB -> delete ( "table", "key", "value" ) - Удаление строк, у которых совпадает ключ/значение
			JsonDB -> deleteAll ( "table" ) - Удаляет все данные таблицы
*/

class JsonTable {

	protected $jsonFile;
	protected $fileHandle;
	protected $fileData = array();
	
	public function __construct($_jsonFile, $create = false) {
		if (!file_exists($_jsonFile)) {
			if($create === true)
			{
				$this->createTable($_jsonFile, true);
			}
			else
			{
				throw new Exception("JsonTable Error: Таблица не найдена: ".$_jsonFile);
			}
		}

		$this->jsonFile = $_jsonFile;
		$this->fileData = json_decode(file_get_contents($this->jsonFile), true);
		$this->lockFile();
	}
	
	public function __destruct() {
		$this->save();
		fclose($this->fileHandle);	
	}
	
	protected function lockFile() {
		$handle = fopen($this->jsonFile, "w");
		if (flock($handle, LOCK_EX)) $this->fileHandle = $handle;
		else throw new Exception("JsonTable Error: file lock не устанавливается");
	}
	
	protected function save() {
		if (fwrite($this->fileHandle, json_encode($this->fileData))) return true;
		else throw new Exception("JsonTable Error: Не могу записать данные в: ".$this->jsonFile);
	}
	
	public function selectAll() {
		return $this->fileData;
	}
	
	public function select($key=0, $val = 0, $equal = true) {
        //if ($key==0 && $val==0) return $this->selectAll();
		$result = array();
		if (is_array($key)) $result = $this->select($key[1], $key[2]);
		else {
			$data = $this->fileData;
			foreach($data as $_key => $_val) {
				if (isset($data[$_key][$key])) {
					if ($equal) {
                        if ($data[$_key][$key] == $val) {
                            $result[] = $data[$_key];
                        }
                    }else{
                        if ($data[$_key][$key] != $val) {
                            $result[] = $data[$_key];
                        }
					}
				}
			}
		}
		return $result;
	}

    public function selectAnd($key1=0, $val1 = 0, $equal1 = true, $key2=0, $val2 = 0, $equal2 = true) {
        //if ($key==0 && $val==0) return $this->selectAll();
        $result = array();
		$data = $this->fileData;
		foreach($data as $_key => $_val) {
            $frst = $scnd = false;
			if (isset($data[$_key][$key1]) || isset($data[$_key][$key2])) {
				if ($equal1){
                    if (($data[$_key][$key1] == $val1))
                        $frst = true;
                    else
                    	$frst = false;
				}else{
                    if (($data[$_key][$key1] == $val1))
                        $frst = false;
                    else
                        $frst = true;
				}
                if ($equal2){
                    if (($data[$_key][$key2] == $val2))
                        $scnd = true;
                    else
                        $scnd = false;
                }else{
                    if (($data[$_key][$key2] == $val2))
                        $scnd = false;
                    else
                        $scnd = true;
                }
                if ($frst && $scnd){
                    $result[] = $data[$_key];
				}
			}
		}
        return $result;
    }
/*
    public function selectWhereAnd($where=null) {
        $result = array();
		$data = $this->fileData;
		foreach($data as $_key => $_val) {
			if (isset($data[$_key][$key])) {
				if ($data[$_key][$key] == $val) {
					$result[] = $data[$_key];
				}
			}
		}
        return $result;
    }*/
	
	public function updateAll($data = array()) {
		if (isset($data[0]) && substr_compare($data[0],$this->jsonFile,0)) $data = $data[1];
		return $this->fileData = array($data);
	}
	
	public function update($key, $val = 0, $newData = array()) {
		$result = false;
		if (is_array($key)) $result = $this->update($key[1], $key[2], $key[3]);
		else {
			$data = $this->fileData;
			foreach($data as $_key => $_val) {
				if (isset($data[$_key][$key])) {
					if ($data[$_key][$key] == $val) {
						$tmp = $data[$_key];
						foreach ($tmp as $key=>$value){
							if (isset($newData[$key]))
                                $tmp[$key] = $newData[$key];
						}
						$data[$_key] = $tmp;
						$result = true;
						break;
					}
				}
			}
			if ($result) $this->fileData = $data;
		}
		return $result;
	}
	
	public function insert($data = array(), $create = false) {
		if (isset($data[0]) && substr_compare($data[0],$this->jsonFile,0)) $data = $data[1];
		if (isset($data['id'])){
			if (strtolower($data['id'])=='a'||strtolower($data['id'])=='auto'||strtolower($data['id'])=='inc'){
				//Значит делаем автоинкремент
				$tmp = $this->selectAll();
				$max = @$tmp[0];
				if ($max) {
					$max = (int)$max;
                    foreach ($tmp as $item) {
                    	if ($max<(int)$item['id']) $max = (int)$item['id'];
                    }
                    $data['id'] = $max+1;
                }else $data['id'] = 1;
			}
		}
		$this->fileData[] = $data;
		return $data;
	}
	
	public function deleteAll() {
		$this->fileData = array();
		return true;
	}
	
	public function delete($key, $val = 0) {
		$result = 0;
		if (is_array($key)) $result = $this->delete($key[1], $key[2]);
		else {
			$data = $this->fileData;
			foreach($data as $_key => $_val) {
				if (isset($data[$_key][$key])) {
					if ($data[$_key][$key] == $val) {
						unset($data[$_key]);
						$result++;
					}
				}
			}
			if ($result) {
				sort($data);
				$this->fileData = $data;
			}
		}
		return $result;
	}

	public function createTable($tablePath) {
		if(is_array($tablePath)) $tablePath = $tablePath[0];
		if(file_exists($tablePath))
			throw new Exception("Таблица уже существует: ".$tablePath);

		if(fclose(fopen($tablePath, 'a')))
		{
			return true;
		}
		else
		{
			throw new Exception("Таблица не создана: ".$tablePath);
		}
	}	
	
}
//JsonDB
class JDB {

	protected $path = "./";
	protected $fileExt = ".json";
	protected $tables = array();
	
	public function __construct($path) {
		if (is_dir($path)) $this->path = $path;
		else throw new Exception("Ошибка JsonDB: База данных не найдена");
	}

	public static function base(){
		//Статическая функция, чтоб можно было юзать
		// JsonDB::base()->Имя_функции();
        include "db_config.php";
		return new JDB($config['path']);
	}
	
	protected function getTableInstance($table, $create) {
		if (isset($tables[$table])) return $tables[$table];
		else return $tables[$table] = new JsonTable($this->path.$table, $create);
	}
	
	public function __call($op, $args) {
		if ($args && method_exists("JsonTable", $op)) {
			$table = $args[0].$this->fileExt;
			$create = false;
			if($op == "createTable")
			{
				return $this->getTableInstance($table, true);
			}
			elseif($op == "insert" && isset($args[2]) && $args[2] === true)
			{
				$create = true;
			}
			return $this->getTableInstance($table, $create)->$op($args);
		} else throw new Exception("JsonDB Error: Неизвестный метод или аргументы ");
	}
	
	public function setExtension($_fileExt) {
		$this->fileExt = $_fileExt;
		return $this;
	}

	public function selectAll($table){
		$table = new JsonTable($this->path.$table.$this->fileExt, false);
		return $table->selectAll();
	}

	public function select($table, $key=0, $val = 0, $equal = true){
        $table = new JsonTable($this->path.$table.$this->fileExt, false);
        return $table->select($key, $val, $equal);
	}

	public function selectOr($table, $wheres){
		/*
		 * where [] = {$key, $equal(true|false), $val}
		 */
		$retar = array();
        $table = new JsonTable($this->path.$table.$this->fileExt, false);
        foreach ($wheres as $where){
        	if (isset($where[0])&&isset($where[2])) {
        		if (isset($where[1])){
        			if ($where[1]==false || $where[1]=='!=')
        				$equl = false;
        			else $equl = true;
				} else $equl = true;
                $tmps = $table->select($where[0],$where[2],$equl);
                if (isset($tmps[0]['id'])) {
                    foreach ($tmps as $tmp) {
                        $retar[$tmp['id']] = $tmp;
                    }
                }else{
                    $retar = array_merge($retar, $tmps);
				}
            }
		}
		return $retar;
	}

    public function selectAnd($table, $key1=0, $val1 = 0, $equal1 = true, $key2=0, $val2 = 0, $equal2 = true){
        $table = new JsonTable($this->path.$table.$this->fileExt, false);
        return $table->selectAnd($key1, $val1, $equal1, $key2, $val2, $equal2);
	}

    public function selectOne($table, $key=0, $val = 0, $equal = true){
        $table = new JsonTable($this->path.$table.$this->fileExt, false);
        $row = $table->select($key, $val, $equal);
        return @$row[0];
    }

    public function updateAll($table, $data = array()){
        $table = new JsonTable($this->path.$table.$this->fileExt, false);
        return $table->updateAll($data);
	}

	public function update($table, $key, $val = 0, $newData = array()){
        $table = new JsonTable($this->path.$table.$this->fileExt, false);
        return $table->update($key,$val,$newData);
	}

	public function deleteAll($table){
        $table = new JsonTable($this->path.$table.$this->fileExt, false);
        return $table->deleteAll();
	}

    public function delete($table, $key, $val = 0){
        $table = new JsonTable($this->path.$table.$this->fileExt, false);
        return $table->delete($key, $val);
	}
}

?>
