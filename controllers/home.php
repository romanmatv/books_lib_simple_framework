<?php defined('INDEX') OR die('Прямой доступ к странице запрещён!');

class Controller_home extends Controller {

    function __construct()
    {
        $this->set_title("Главная");
        $this->set_active('home');
    }

    public function action_index(){
        $activs = JDB::base()->select('takens','date_close','NULL');
        $activs_table = "";
        foreach ($activs as $activ){
            $btns = "<a href='?page=home&action=close&id=$activ[id]' class='btn btn-sm btn-default' title='Вернуть'><i class='fa fa-retweet'></i></a>
                     <a href='?page=home&action=prolong&id=$activ[id]' class='btn btn-sm btn-default' title='Продлить'><i class='fa fa-plus'></i></a>";
            $book = JDB::base()->selectOne('books','id', (int)$activ['book_id']);
            $reader = JDB::base()->selectOne('readers','id', (int)$activ['reader_id']);
            $reader_fio = $this->shortfio($reader);
            $days = View::interval($activ['date_ret'], date('Y-m-d'), 'd',true);
            $activs_table .="<tr>
<td><a href='?page=books&page=book&id=$book[id]' target='_blank'>$book[name]</a></td>
<td><a href='?page=readers&page=reader&id=$reader[id]' target='_blank'>$reader_fio</a></td>
<td>".(View::date_format($activ['date_from']))."</td>
<td>".(View::date_format($activ['date_ret']))."</td>
<td>$days</td>
<td><div class='btn-group'>$btns</div></td>
</tr>";
        }
        $readers = View::select_options(JDB::base()->selectAll('readers'),'id','F:fio');
        $books = JDB::base()->select('books','reader_id',0);
        $books = View::select_options($books,'id','name');
        $respon = array(
            'activs_table'=>$activs_table,
            'readers'=>$readers,
            'books'=>$books,
            'now_date'=>date('Y-m-d',strtotime('+1 week'))
        );
        $this->set_content(View::factory('home',$respon));
    }

    public function action_add(){
        $reader = (int)$this->post('reader');
        $book = (int)$this->post('book');
        $date_ret = date('Y-m-d', strtotime($this->post('date_ret')));
        $date_from = date('Y-m-d');
        $q = JDB::base()->insert('takens',array(
            'id'=>'a',
            'book_id'=>$book,
            'reader_id'=>$reader,
            'date_from'=>$date_from,
            'date_ret'=>$date_ret,
            'date_close'=>'NULL'
        ),true);
        JDB::base()->update('books','id',$book,array('reader_id'=>$reader,'takken_id'=>$q['id']));
        $this->redirect('/');
    }

    public function action_close(){
        $taken = (int)$this->get('id');
        JDB::base()->update('takens','id',$taken,array('date_close'=>date('Y-m-d')));
        $taken = JDB::base()->selectOne('takens','id',$taken);
        JDB::base()->update('books','id',$taken['book_id'],array('reader_id'=>0,'takken_id'=>0));
        $this->redirect('/');
    }

    public function action_prolong(){
        $taken = (int)$this->get('id');
        $newDate = date('Y-m-d',strtotime('+ 1 week'));
        JDB::base()->update('takens','id',$taken,array('date_ret'=>$newDate));
        $this->redirect('/');
    }

    public function action_archive(){
        $activs = JDB::base()->select('takens','date_close','NULL',false);
        $activs_table = "";
        foreach ($activs as $activ){
            $book = JDB::base()->selectOne('books','id', (int)$activ['book_id']);
            $reader = JDB::base()->selectOne('readers','id', (int)$activ['reader_id']);
            $reader_fio = $this->shortfio($reader);
            $allDays = View::interval($activ['date_from'], $activ['date_close']);
            $days = View::interval($activ['date_ret'], $activ['date_close'], 'd',true);
            if ($days<0)
                $days = 0;
            $activs_table .="<tr>
<td><a href='?page=books&page=book&id=$book[id]' target='_blank'>$book[name]</a></td>
<td><a href='?page=readers&page=reader&id=$reader[id]' target='_blank'>$reader_fio</a></td>
<td>".(View::date_format($activ['date_from']))."</td>
<td>".(View::date_format($activ['date_close']))."</td>
<td>$allDays</td>
<td>$days</td>
</tr>";
        }
        $respon = array(
            'activs_table'=>$activs_table,
            'now_date'=>date('Y-m-d',strtotime('+1 week'))
        );
        $this->set_content(View::factory('archive',$respon));
    }

    public function action_test(){
        $tmp = JDB::base()->select('takens',array('id','id',5,'reader_id','reader_id',1));
        var_dump($tmp);
    }
}