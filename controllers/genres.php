<?php defined('INDEX') OR die('Прямой доступ к странице запрещён!');

class Controller_genres extends Controller {

    function __construct()
    {
        $this->set_title('Жанры');
        $this->set_active('genres');
    }

    public function action_index(){
        if ($this->is_post()){
            $name = $this->post('name');
            if ($name){
                JDB::base()->insert('genres',array('id'=>'a','name'=>$name));
            }
        }
        $genres = JDB::base()->selectAll('genres');
        $genres_table = "";
        foreach ($genres as $genre){
            $genres_table .="<tr>
<td>$genre[id]</td>
<td>$genre[name]</td>
<td><a href='?page=genres&action=delete&id=$genre[id]' class='btn btn-sm btn-danger'><i class='icon-trash'></i></a></td>
</tr>";
        }
        $resp = array('genres_table'=>$genres_table);
        $this->set_content(View::factory('genres',$resp));
    }

    public function action_delete(){
        $id = (int)$this->get('id');
        if ($id)
            JDB::base()->delete('genges','id',$id);
        $this->redirect('/?page=genres');
    }
}