<div class="col-md-5">
    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-user"></i>
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
                        <label for="direcktor" class="col-lg-4">Директор</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="direcktor" value="$direcktor$" id="direcktor">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="site" class="col-lg-4">Сайт</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="site" value="$site$" id="site">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-lg-4">Дата основания</label>

                        <div class="col-lg-8">
                            <input type="date" class="form-control" name="date" value="$date$" id="date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date_add" class="col-lg-4">Дата добавления</label>

                        <div class="col-lg-8">
                            <input type="date" disabled class="form-control" name="date_add" value="$date_add$" id="date_add">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4"></div>

                        <div class="col-lg-8">
                            <a href="?page=publishers" class="btn btn-default"><i class="icon-arrow-left"></i> Назад</a>
                            <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Сохранить</button>
                        </div>
                    </div>


                </fieldset>
            </form>


        </div> <!-- /widget-content -->

    </div> <!-- /widget -->
</div>
<!--   Книги    -->
<div class="col-md-7">
    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-book"></i>
            <h3>Книги</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Читатель</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                $books_table$
                </tbody>
            </table>

        </div> <!-- /widget-content -->

    </div> <!-- /widget -->
</div>