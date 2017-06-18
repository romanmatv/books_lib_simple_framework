<?php defined('INDEX') OR die('Прямой доступ к странице запрещён!');

class Controller_publishers extends Controller {
    function __construct()
    {
        $this->set_title("Издатели");
        $this->set_active('publishers');
    }

    public function action_index(){
        $publishers = JDB::base()->selectAll('publishers');
        $publishers_table = "";
        foreach ($publishers as $publisher){
            $btns = "<a href='?page=publishers&action=publisher&id=$publisher[id]' class='btn btn-sm btn-default'><i class='icon-pencil'></i></a><a href='?page=publisher&action=delete&id=$publisher[id]' class='btn btn-sm btn-danger'><i class='icon-trash'></i></a>";
            $publishers_table .="<tr>
<td>$publisher[name]</td>
<td>".View::date_format($publisher['date'])."</td>
<td>$publisher[direcktor]</td>
<td><div class='btn-group'>$btns</div></td>
</tr>";
        }
        $this->set_content(View::factory('publishers',array('publishers_table'=>$publishers_table)));
    }

    public function action_add(){
        $content = View::factory('add_publisher');
        $this->set_content($content);
        if ($this->is_post()){
            $name = $this->post('name');
            $direcktor = $this->post('direcktor');
            $site = $this->post('site');
            $date = date('Y-m-d',strtotime($this->post('date')));
            $q = JDB::base()->insert('publishers',array(
                'id'=>'a',
                'name'=>$name,
                'direcktor'=>$direcktor,
                'date'=>$date,
                'site'=>$site,
                'date_add'=>date('Y-m-d')),true);
            $this->redirect('?page=publishers&action=publisher&id='.$q['id']);
        }
    }

    public function action_publisher(){
        $publisher_id = (int)$this->get('id');
        $publisher = JDB::base()->select("publishers",'id',$publisher_id);
        $publisher = @$publisher[0];
        if ($publisher){
            if ($this->is_post()){
                $name = $this->post('name');
                $direcktor = $this->post('direcktor');
                $site = $this->post('site');
                $date = date('Y-m-d',strtotime($this->post('date')));
                $publisher = array(
                    'id'=>(int)$publisher_id,
                    'name'=>$name,
                    'direcktor'=>$direcktor,
                    'site'=>$site,
                    'date'=>$date,
                    'date_add'=>$publisher['date_add']
                );
                JDB::base()->update('publishers','id',(int)$publisher_id,$publisher);
            }
            //////////////
            $books = JDB::base()->select('books','publisher_id',$publisher_id);
            $books_table = "";
            foreach ($books as $book){
                $author = JDB::base()->selectOne('authors','id',$book['author_id']);
                $author = $this->shortfio($author);
                $publisher = JDB::base()->selectOne('publishers','id',$book['publisher_id']);
                $genre = JDB::base()->selectOne('genres','id',$book['genre']);
                $btns = "<a href='?page=books&action=book&id=$book[id]' class='btn btn-sm btn-default'><i class='icon-pencil'></i></a><a href='?page=books&action=delete&id=$book[id]' class='btn btn-sm btn-danger'><i class='icon-trash'></i></a>";
                $books_table .="<tr>
<td>$book[name]</td>
<td>$genre[name]</td>
<td>".View::date_format($book['date'])."</td>
<td>$author</td>
<td><div class='btn-group'>$btns</div></td>
</tr>";
            }
            $publisher['books_table'] = $books_table;
            $this->set_content(View::factory('edit_publisher',$publisher));
        }else{
            $this->set_content('<div class="alert">Издатель не найден</div>');
        }
    }

    public function action_delete(){
        $author_id = (int)$this->get('id');
        JDB::base()->delete('publishers','id',$author_id);
        $this->redirect('?page=publishers');
    }
}