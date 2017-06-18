<div class="col-md-5">
    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-book"></i>
            <h3>$name$</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <form id="validation-form" method="post" role="form" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label for="name" class="col-lg-4">Название</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="name" value="$name$" id="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="author_id" class="col-lg-4">Автор</label>

                        <div class="col-lg-8">
                            <select class="form-control" name="author_id" id="author_id">
                                $authors$
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="publisher_id" class="col-lg-4">Издатель</label>

                        <div class="col-lg-8">
                            <select class="form-control" name="publisher_id" id="publisher_id">
                                $publishers$
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="genre" class="col-lg-4">Жанр</label>

                        <div class="col-lg-8">
                            <select class="form-control" name="genre" id="genre">
                                $genres$
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-lg-4">Дата выпуска</label>

                        <div class="col-lg-8">
                            <input type="date" class="form-control" name="date" value="$date$" id="date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pages" class="col-lg-4">Страницы</label>

                        <div class="col-lg-8">
                            <input type="number" class="form-control" name="pages" value="$pages$" id="pages">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date_add" class="col-lg-4">Дата добавления</label>

                        <div class="col-lg-8">
                            <input type="date" class="form-control" name="date_add" value="$date_add$" id="date_add" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4"></div>

                        <div class="col-lg-8">
                            <a href="?page=authors" class="btn btn-default"><i class="icon-arrow-left"></i> Назад</a>
                            <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Сохранить</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div> <!-- /widget-content -->
    </div> <!-- /widget -->
</div>

<!------Выданные книжки---->
<div class="col-md-7">
    <div class="widget stacked ">
        <div class="widget-header">
            <i class="icon-history"></i>
            <h3>История</h3>
        </div> <!-- /widget-header -->
        <div class="widget-content">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#active" data-toggle="tab">Выдать</a>
                    </li>
                    <li><a href="#archive" data-toggle="tab">Архив</a></li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="active">
                        $active_form$
                    </div>

                    <div class="tab-pane" id="archive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Читатель</th>
                                <th>Дата выдачи</th>
                                <th>Дата возврата</th>
                                <th>Дней в выдачи</th>
                                <th>Просрочено из них</th>
                            </tr>
                            </thead>
                            <tbody>
                            $archive_table$
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- /widget-content -->
    </div> <!-- /widget -->
</div> <!-- /span8 -->