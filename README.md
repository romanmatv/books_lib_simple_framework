# books_lib_simple_framework
Simple PHP Framework for books library

# Russian
Написанный ради курсового проекта очень простой PHP Framework. Реализованы Контроллеры и Виды.
Как пример, сделана очень простая система для потенциальной библиотеки. В качестве базы данных исполузуются Json файлы (требование работы, не использовать готовые БД).
Точка входа index.php
В ней прописываются глобальные константы и подключается контроллер.
Стандартно все ошибки отображаются, но редактируемо в index.php
Названия контроллера (класса) и вида должно быть строчными буквами
Пример адресной строки hostname/?page=назвавние-контроллера&action=название-экшона
Все экшены пишутся публичной функцией action_name(){}
В глобальную переменную $content передается HTML код страницы в виде текста

Через функцию View::factory('name_page',varibles) задается имя вида и переменные в виде массива ('имя переменной в виде'=>'Значение')
Допускаются только числовые или строчные значения.
Переменные в виде задаются в виде $var_name$ и заменяются средствами str_replace()
Функция возвращает HTML код, который можно передать в $content

# JDB
За основу был взят проект https://github.com/strzlee/JsonDB.class.php и доработан для использования в данном проекте.
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
     
Так же можно просто вызвать через JDB::base()->Имя-функции(); в любом месте данного проекта
Для упрощения некоторых процессов в Controller и View прописаны готовые функции локального представления даты, интервала дат, работа с POST и GET, составление option для select на основе массива и другие полезные мелочи.

Через set_active('name') можно задать активный раздел менюшки на сайте, если это предусмотрено в главном шаблоне сайта.
Функции post и get возвращают значения по переданным идентификаторам (принимается как единичное значение, так и массив), если значение не найдено то NULL.

Функция is_post возвращает true, если был запрос типа POST, иначе false.
