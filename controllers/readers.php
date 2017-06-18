<?php defined('INDEX') OR die('Прямой доступ к странице запрещён!');

class Controller_readers extends Controller {
    function __construct()
    {
        $this->set_title("Читатели");
        $this->set_active('readers');
    }

    public function action_index(){
        $authors = JDB::base()->selectAll('readers');
        $authors_table = "";
        foreach ($authors as $author){
            $btns = "<a href='?page=readers&action=reader&id=$author[id]' class='btn btn-sm btn-default'><i class='icon-pencil'></i></a><a href='?page=readers&action=delete&id=$author[id]' class='btn btn-sm btn-danger'><i class='icon-trash'></i></a>";
            $authors_table .="<tr>
<td>$author[lastname]</td>
<td>$author[firstname]</td>
<td>$author[patronymic]</td>
<td>".View::date_format($author['birthdate'])."</td>
<td><div class='btn-group'>$btns</div></td>
</tr>";
        }
        $this->set_content(View::factory('readers',array('authors_table'=>$authors_table)));
    }

    public function action_add(){
        $content = View::factory('add_reader');
        $this->set_content($content);
        if ($this->is_post()){
            $firstname = $this->post('firstname');
            $lastname = $this->post('lastname');
            $patronymic = $this->post('patronymic');
            $birthdate = date('Y-m-d',strtotime($this->post('birthdate')));
            $q = JDB::base()->insert('readers',array(
                'id'=>'a',
                'firstname'=>$firstname,
                'lastname'=>$lastname,
                'patronymic'=>$patronymic,
                'birthdate'=>$birthdate),true);
            $this->redirect('?page=readers&action=reader&id='.$q['id']);
        }
    }

    public function action_reader(){
        $author_id = (int)$this->get('id');
        $author = JDB::base()->select("readers",'id',$author_id);
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
                JDB::base()->update('readers','id',(int)$author_id,$author);
            }
            $author['fio'] = $author['lastname'].' '.$author['firstname'].' '.$author['patronymic'];
            /*
             * Получим выданные книги
             */
            $activs = JDB::base()->selectAnd('takens','date_close','NULL',true, 'reader_id',$author['id']);
            $activs_table = "";
            foreach ($activs as $activ){
                $btns = "<a href='?page=home&action=close&id=$activ[id]' class='btn btn-sm btn-default' title='Вернуть'><i class='fa fa-retweet'></i></a>
                     <a href='?page=home&action=prolong&id=$activ[id]' class='btn btn-sm btn-default' title='Продлить'><i class='fa fa-plus'></i></a>";
                $book = JDB::base()->selectOne('books','id', (int)$activ['book_id']);
                $days = View::interval($activ['date_ret'], date('Y-m-d'), 'd',true);
                $activs_table .="<tr>
<td><a href='?page=books&action=book&id=$book[id]' target='_blank'>$book[name]</a></td>
<td>".(View::date_format($activ['date_from']))."</td>
<td>".(View::date_format($activ['date_ret']))."</td>
<td>$days</td>
<td><div class='btn-group'>$btns</div></td>
</tr>";
            }
            $author['activs_table'] = $activs_table;

            $activs = JDB::base()->selectAnd('takens','date_close','NULL',false, 'reader_id',$author['id']);
            $activs_table = "";
            foreach ($activs as $activ){
                $book = JDB::base()->selectOne('books','id', (int)$activ['book_id']);
                $allDays = View::interval($activ['date_from'], $activ['date_close']);
                $days = View::interval($activ['date_ret'], $activ['date_close'], 'd',true);
                if ($days<0)
                    $days = 0;
                $activs_table .="<tr>
<td><a href='?page=books&action=book&id=$book[id]' target='_blank'>$book[name]</a></td>
<td>".(View::date_format($activ['date_from']))."</td>
<td>".(View::date_format($activ['date_close']))."</td>
<td>$allDays</td>
<td>$days</td>
</tr>";
            }
            $author['archive_table'] = $activs_table;
            $this->set_content(View::factory('edit_reader',$author));
        }else{
            $this->set_content('<div class="alert">Читатель не найден</div>');
        }
    }

    public function action_delete(){
        $author_id = (int)$this->get('id');
        JDB::base()->delete('readers','id',$author_id);
        $this->redirect('?page=readers');
    }
}