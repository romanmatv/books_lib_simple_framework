<div class="col-md-8">
    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-book"></i>
            <h3>Выданные книги</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <ul class="nav nav-pills">
                <li class="active"><a href="/">Выданные</a></li>
                <li><a href="?page=home&action=archive">Архив</a></li>
            </ul>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Книга</th>
                    <th>Читатель</th>
                    <th>Дата выдачи</th>
                    <th>Дата возврата</th>
                    <th>Дни</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                $activs_table$
                </tbody>
            </table>
        </div> <!-- /widget-content -->

    </div> <!-- /widget -->
</div>

<div class="col-md-4">
    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-book"></i>
            <h3>Выдача книги</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <form method="post" action="?page=home&action=add" name="new_read" class="form-inline" role="form">
                <fieldset>
                    <div class="form-group">
                        <label for="book">Выбрать книгу</label>
                        <select id="book" name="book" class="form-control" required>
                            <option></option>
                            $books$
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reader">Выбрать читателя</label>
                        <select id="reader" name="reader" class="form-control" required>
                            <option></option>
                            $readers$
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_ret">Дата возврата</label>
                        <input class="form-control" type="date" name="date_ret" id="date_ret" value="$now_date$" required>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <button type="submit" class="btn btn-success">Выдать</button>
                    <button type="reset" class="btn btn-primary">Сбросить</button>
                </fieldset>
            </form>
        </div> <!-- /widget-content -->

    </div> <!-- /widget -->
</div>