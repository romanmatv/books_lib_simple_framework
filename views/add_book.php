<div class="col-md-12">


    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-bookmark"></i>
            <h3>Новая книга</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">

            <form id="validation-form" method="post" role="form" class="form-horizontal col-md-7">

                <fieldset>
                    <div class="form-group">
                        <label for="name" class="col-lg-4">Название книги</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-lg-4">Дата выпуска</label>

                        <div class="col-lg-8">
                            <input type="date" class="form-control" name="date" id="date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pages" class="col-lg-4">Колличество страниц</label>

                        <div class="col-lg-8">
                            <input type="number" class="form-control" name="pages" id="pages">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="author" class="col-lg-4">Автор</label>
                        <div class="col-lg-8">
                            <select id="author" name="author" class="form-control">
                                <option></option>
                                $author_select$
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="publisher" class="col-lg-4">Издатель</label>
                        <div class="col-lg-8">
                            <select id="publisher" name="publisher" class="form-control">
                                <option></option>
                                $publisher_select$
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="genre" class="col-lg-4">Жанр</label>
                        <div class="col-lg-8">
                            <select id="genre" name="genre" class="form-control">
                                <option></option>
                                $genre_select$
                            </select>
                        </div>
                    </div>

                    <br />

                    <div class="form-group">
                        <div class="col-lg-4"></div>

                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Сохранить</button>&nbsp;&nbsp;
                        </div>
                    </div>
                </fieldset>
            </form>


        </div> <!-- /widget-content -->

    </div> <!-- /widget -->
