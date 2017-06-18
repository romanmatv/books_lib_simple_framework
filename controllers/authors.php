<?php defined('INDEX') OR die('Прямой доступ к странице запрещён!');

class Controller_authors extends Controller {
    function __construct()
    {
        $this->set_title("Авторы");
        $this->set_active('authors');
    }

    public function action_index(){
        $authors = JDB::base()->selectAll('authors');
        $authors_table = "";
        foreach ($authors as $author){
            $btns = "<a href='?page=authors&action=author&id=$author[id]' class='btn btn-sm btn-default'><i class='icon-pencil'></i></a><a href='?page=authors&action=delete&id=$author[id]' class='btn btn-sm btn-danger'><i class='icon-trash'></i></a>";
            $authors_table .="<tr>
<td>$author[lastname]</td>
<td>$author[firstname]</td>
<td>$author[patronymic]</td>
<td>".View::date_format($author['birthdate'])."</td>
<td><div class='btn-group'>$btns</div></td>
</tr>";
        }
        $this->set_content(View::factory('authors',array('authors_table'=>$authors_table)));
    }

    public function action_add(){
        $content = View::factory('add_author');
        $this->set_content($content);
        if ($this->is_post()){
            $firstname = $this->post('firstname');
            $lastname = $this->post('lastname');
            $patronymic = $this->post('patronymic');
            $birthdate = date('Y-m-d',strtotime($this->post('birthdate')));
            $q = JDB::base()->insert('authors',array(
                'id'=>'a',
                'firstname'=>$firstname,
                'lastname'=>$lastname,
                'patronymic'=>$patronymic,
                'birthdate'=>$birthdate),true);
            $this->redirect('?page=authors&action=author&id='.$q['id']);
        }
    }

    public function action_author(){
        $author_id = (int)$this->get('id');
        $author = JDB::base()->select("authors",'id',$author_id);
        $author = @$author[0];
        if ($author){
            if ($this->is_post()){
                $firstname = $this->post('firstname');
                $lastname = $this->post('lastname');
                $patronymic = $this->post('patronymic');
                $birthdate = date('Y-m-d',strtotime($this->post('birthdate')));
                $author = array(
                    'id'=>(int)$author_id,
                    'firstname'=>$firstname,
                    'lastname'=>$lastname,
                    'patronymic'=>$patronymic,
                    'birthdate'=>$birthdate
                );
                JDB::base()->update('authors','id',(int)$author_id,$author);
            }
            $author['fio'] = $author['lastname'].' '.$author['firstname'].' '.$author['patronymic'];
            /////////
            $books = JDB::base()->selectAll('books');
            $books_table = "";
            foreach ($books as $book){
                $publisher = JDB::base()->selectOne('publishers','id',$book['publisher_id']);
                $genre = JDB::base()->selectOne('genres','id',$book['genre']);
                $btns = "<a href='?page=books&action=book&id=$book[id]' class='btn btn-sm btn-default'><i class='icon-pencil'></i></a><a href='?page=books&action=delete&id=$book[id]' class='btn btn-sm btn-danger'><i class='icon-trash'></i></a>";
                $books_table .="<tr>
<td>$book[name]</td>
<td>$genre[name]</td>
<td>".View::date_format($book['date'])."</td>
<td>$publisher[name]</td>
<td><div class='btn-group'>$btns</div></td>
</tr>";
            }
            $author['books_table'] = $books_table;
            $this->set_content(View::factory('edit_author',$author));
        }else{
            $this->set_content('<div class="alert">Автор не найден</div>');
        }
    }

    public function action_delete(){
        $author_id = (int)$this->get('id');
        JDB::base()->delete('authors','id',$author_id);
        $this->redirect('?page=authors');
    }
}