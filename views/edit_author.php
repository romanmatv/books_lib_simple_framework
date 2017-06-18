<div class="col-md-5">


    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-user"></i>
            <h3>$fio$</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">

            <form id="validation-form" method="post" role="form" class="form-horizontal">

                <fieldset>
                    <div class="form-group">
                        <label for="lastname" class="col-lg-4">Фамилия</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="lastname" value="$lastname$" id="lastname">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstname" class="col-lg-4">Имя</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="firstname" value="$firstname$" id="firstname">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="patronymic" class="col-lg-4">Отчество</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="patronymic" value="$patronymic$" id="patronymic">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="birthdate" class="col-lg-4">Дата рождения</label>

                        <div class="col-lg-8">
                            <input type="date" class="form-control" name="birthdate" value="$birthdate$" id="birthdate">
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
                    <th>Издатель</th>
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
