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
                        <a href="#active" data-toggle="tab">Выданные</a>
                    </li>
                    <li><a href="#archive" data-toggle="tab">Архив</a></li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="active">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Книга</th>
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
                    </div>

                    <div class="tab-pane" id="archive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Книга</th>
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