<?php defined('INDEX') OR die('Прямой доступ к странице запрещён!');

class Controller_books extends Controller {
    function __construct()
    {
        $this->set_title("Книги");
        $this->set_active('books');
    }

    public function action_index(){
        $books = JDB::base()->selectAll('books');
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
<td>$publisher[name]</td>
<td><div class='btn-group'>$btns</div></td>
</tr>";
        }
        $this->set_content(View::factory('books',array('books_table'=>$books_table)));
    }

    public function action_add(){
        $authors = JDB::base()->selectAll('authors');
        $genres = JDB::base()->selectAll('genres');
        $publishers = JDB::base()->selectAll('publishers');
        $author_select = View::select_options($authors,'id',array('firstname','lastname'));
        $publisher_select = View::select_options($publishers,'id','name');
        $genre_select = View::select_options($genres,'id','name');
        $resp = array(
            'author_select'=>$author_select,
            'publisher_select'=>$publisher_select,
            'genre_select'=>$genre_select
        );
        $this->set_content(View::factory('add_book',$resp));
        if ($this->is_post()){
            $name = $this->post('name');
            $author = (int)$this->post('author');
            $publisher = (int)$this->post('publisher');
            $genre = (int)$this->post('genre');
            $pages = (int)$this->post('pages');
            $date = date('Y-m-d',strtotime($this->post('date')));
            $q = JDB::base()->insert('books',array(
                'id'=>'a',
                'name'=>$name,
                'author_id'=>$author,
                'publisher_id'=>$publisher,
                'genre'=>$genre,
                'pages'=>$pages,
                'date'=>$date,
                'reader_id'=>0,
                'takken_id'=>0,
                'date_add'=>date('Y-m-d H:i:s')),true);
            $this->redirect('?page=books&action=book&id='.$q['id']);
        }
    }

    public function action_book(){
        $book_id = (int)$this->get('id');
        $book = JDB::base()->selectOne("books",'id',$book_id);

        if ($book) {
            if ($this->is_post()){
                $name = $this->post('name');
                $author = (int)$this->post('author_id');
                $publisher = (int)$this->post('publisher_id');
                $genre = (int)$this->post('genre');
                $pages = (int)$this->post('pages');
                $date = date('Y-m-d',strtotime($this->post('date')));
                JDB::base()->update('books','id',$book['id'],array(
                    'name'=>$name,
                    'author_id'=>$author,
                    'publisher_id'=>$publisher,
                    'genre'=>$genre,
                    'pages'=>$pages,
                    'date'=>$date));
                $this->redirect('?page=books&action=book&id='.$book['id']);
            }

            if ($book['reader_id']) {
                $btns = "<a href='?page=home&action=close&id=$book[takken_id]' class='btn btn-sm btn-default' title='Вернуть'><i class='fa fa-retweet'></i></a>
                     <a href='?page=home&action=prolong&id=$book[takken_id]' class='btn btn-sm btn-default' title='Продлить'><i class='fa fa-plus'></i></a>";
                $book = JDB::base()->selectOne('books', 'id', (int)$book['id']);
                $reader = JDB::base()->selectOne('readers', 'id', (int)$book['reader_id']);
                $reader_fio = $this->shortfio($reader);
                $activ = JDB::base()->selectOne('takens', 'id', $book['takken_id']);
                $days = View::interval($activ['date_ret'], date('Y-m-d'), 'd', true);
                $active_form = "
<table class=\"table table-striped\">
                <thead>
                <tr>
                    <th>Читатель</th>
                    <th>Дата выдачи</th>
                    <th>Дата возврата</th>
                    <th>Дни</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
<tr>
<td><a href='?page=readers&page=reader&id=$reader[id]' target='_blank'>$reader_fio</a></td>
<td>" . (View::date_format($activ['date_from'])) . "</td>
<td>" . (View::date_format($activ['date_ret'])) . "</td>
<td>$days</td>
<td><div class='btn-group'>$btns</div></td>
</tr>
</tbody>
            </table>";
            } else {
                $readers = View::select_options(JDB::base()->selectAll('readers'), 'id', 'F:fio');
                $now_date = date('Y-m-d', strtotime('+1 week'));
                $active_form = "<form method=\"post\" action=\"?page=home&action=add\" name=\"new_read\" class=\"form-inline\" role=\"form\">
                <fieldset>
                    <input type=\"hidden\" name=\"book\" id=\"book\" value=\"$book[id]\">
                    <div class=\"form-group\">
                        <label for=\"reader\">Выбрать читателя</label>
                        <select id=\"reader\" name=\"reader\" class=\"form-control\" required>
                            <option></option>
                            $readers
                        </select>
                    </div>
                    <div class=\"form-group\">
                        <label for=\"date_ret\">Дата возврата</label>
                        <input class=\"form-control\" type=\"date\" name=\"date_ret\" id=\"date_ret\" value=\"$now_date\" required>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <button type=\"submit\" class=\"btn btn-success\">Выдать</button>
                    <button type=\"reset\" class=\"btn btn-primary\">Сбросить</button>
                </fieldset>
            </form>";
            }
            $archives = JDB::base()->selectAnd('takens', 'date_close', 'NULL', false, 'book_id', $book['id']);
            $archive_table = "";
            foreach ($archives as $archive) {
                $book = JDB::base()->selectOne('books', 'id', (int)$archive['book_id']);
                $allDays = View::interval($archive['date_from'], $archive['date_close']);
                $days = View::interval($archive['date_ret'], $archive['date_close'], 'd', true);
                $reader = JDB::base()->selectOne('readers', 'id', (int)$archive['reader_id']);
                $reader_fio = $this->shortfio($reader);
                if ($days < 0)
                    $days = 0;
                $archive_table .= "<tr>
<td><a href='?page=readers&action=reader&id=$reader[id]' target='_blank'>$reader_fio</a></td>
<td>" . (View::date_format($archive['date_from'])) . "</td>
<td>" . (View::date_format($archive['date_close'])) . "</td>
<td>$allDays</td>
<td>$days</td>
</tr>";
            }
            $book['archive_table'] = $archive_table;
            $book['active_form'] = $active_form;

            $book['authors'] = View::select_options(JDB::base()->selectAll('authors'), 'id', 'F:fio', ' ', $book['author_id']);
            $book['publishers'] = View::select_options(JDB::base()->selectAll('publishers'), 'id', 'name', ' ', $book['publisher_id']);
            $book['genres'] = View::select_options(JDB::base()->selectAll('genres'), 'id', 'name', ' ', $book['genre']);

            $this->set_content(View::factory('edit_book', $book));
        }else{
            $this->set_content('<div class="alert">Книга не найден</div>');
        }
    }
}