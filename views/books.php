<div class="col-md-12">
    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-book"></i>
            <h3>Список книг</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <a href="?page=authors&action=add" class="btn btn-success"><i class="icon-plus"></i> Добавить</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Жанр</th>
                    <th>Дата выхода</th>
                    <th>Автор</th>
                    <th>Издательство</th>
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