<div class="col-md-12">
    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-tags"></i>
            <h3>Список жанров</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <form method="post" class="form-inline">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Название жанра" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_genre" class="btn btn-success"><i class="icon-plus"></i> Добавить</button>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    $genres_table$
                </tbody>
            </table>
        </div> <!-- /widget-content -->

    </div> <!-- /widget -->
</div>