<?php require_once ROOT . "/views/layouts/header.php"; ?>

    <!-- Модальное окно смены пароля -->
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Смена пароля</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Введите старий пароль</label>
                            <input type="password" class="form-control" id="old_pass"
                                   placeholder="Старый пароль...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Введите новый пароль</label>
                            <input type="password" class="form-control" id="new_pass"
                                   placeholder="Новый пароль...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Введите новый пароль снова</label>
                            <input type="password" class="form-control" id="rep_pass"
                                   placeholder="Новый пароль...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="change_password">Готово</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Профиль пользователя -->

    <div class="container card" id="view">

        <div class="row" style="text-align: center;">
            <div class="col">
                <h2><?php echo User::getUserNameBySession(); ?></h2>
                <p>
                    <?php if (User::userIsAdmin()): ?>
                        (admin)
                    <?php endif; ?>
                </p>
                <h6><label style="color: #bb7b29;">Email:</label><?php echo ' ' . User::getUserEmailBySession(); ?></h6>
                <button type="button" class="btn btn-outline-info" data-toggle="modal"
                        data-target="#exampleModalCenter2">Изменить пароль
                </button>
                <br><br>
            </div>
        </div>

        <!-- Администратор -->
        <?php if (User::userIsAdmin()) { ?>

            <!-- Модальные окна для добавления сущностей -->

            <!-- Добавлнеие фильма -->
            <div class="modal fade" id="add-film" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Добавление фильма</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group" id="list">
                                    <label for="film-name">Название фильма</label>
                                    <input required type="text" class="form-control" id="film-name"
                                           placeholder="Введите название...">
                                    <label for="film-age">Возрастные ограничения</label>
                                    <input type="text" class="form-control" id="film-age"
                                           placeholder="Введите возраст...">
                                    <label for="film-original-name">Оригинальное название фильма</label>
                                    <input type="text" class="form-control" id="film-original-name"
                                           placeholder="Введите оригинальное название фильма...">
                                    <label for="film-producer">Режиссёр</label>
                                    <input type="text" class="form-control" id="film-producer"
                                           placeholder="Введите имя режиссера...">
                                    <label for="film-rent-start">Начало проката</label>
                                    <input type="date" class="form-control" id="film-rent-start"
                                           placeholder="Введите начало периода проката...">
                                    <label for="film-rent-end">Конец проката</label>
                                    <input type="date" class="form-control" id="film-rent-end"
                                           placeholder="Введите конец периода проката...">
                                    <label for="film-rating">Рейтинг фильма</label>
                                    <input type="text" class="form-control" id="film-rating"
                                           placeholder="Введите рейтинг фильма...">
                                    <label for="film-language">Язык фильма</label>
                                    <input type="text" class="form-control" id="film-language"
                                           placeholder="Введите язык фильма...">
                                    <label for="film-duration">Длительность фильма</label>
                                    <input type="text" class="form-control" id="film-duration"
                                           placeholder="Введите длительность фильма...">
                                    <label for="film-production">Страну производителя фильма</label>
                                    <input type="text" class="form-control" id="film-production"
                                           placeholder="Введите страну производителя фильма...">
                                    <label for="film-scenario">Сценарий</label>
                                    <input type="text" class="form-control" id="film-scenario"
                                           placeholder="Введите сценариста фильма...">
                                    <label for="film-starring">В главных ролях</label>
                                    <textarea class="form-control" id="film-starring"
                                              placeholder="Введите актеров главных ролях..."></textarea>
                                    <label for="film-description">Описание фильма</label>
                                    <textarea class="form-control" id="film-description"
                                              placeholder="Введите описание фильма..."></textarea>
                                    <label for="film-trailer">Трейлер</label>
                                    <input type="text" class="form-control" id="film-trailer"
                                           placeholder="Ссылка на трейлер...">
                                </div>


                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="is-available">
                                    <label class="form-check-label" for="is-available">Доступен ли фильм</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="is-important">
                                    <label class="form-check-label" for="is-important">В тренде ли фильм</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="button" id="submit-film" class="btn btn-primary">Готово</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Добавление сеанса -->
            <div class="modal fade" id="add-session" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Добавление сеанса</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group" id="list">
                                    <label for="session-film-name">Выберите фильм</label>
                                    <select class="custom-select" id="session-film-name">
                                        <?php $i = 0;
                                        foreach ($filmList as $film): ?>
                                            <option <?php echo ($i = 0) ? 'selected' : '';
                                            $i++; ?>
                                                    id="<?php echo $film['id']; ?>"><?php echo $film['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="session-hall-name">Выберите зал</label>
                                    <select class="custom-select" id="session-hall-name">
                                        <?php $i = 0;
                                        foreach ($hallList as $hall): ?>
                                            <option <?php echo ($i = 0) ? 'selected' : '';
                                            $i++; ?>
                                                    id="<?php echo $hall['id']; ?>"><?php echo $hall['name'] .
                                                    ' (к-во мест: ' . $hall['number_of_sits'] . ')' ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="session-date">Дата сеанса</label>
                                    <input type="date" class="form-control" id="session-date"
                                           placeholder="Введите дату показа...">
                                    <label for="session-time">Время сеанса</label>
                                    <input class="form-control" type="time" id="session-time">
                                    <label for="session-price">Цена сеанса</label>
                                    <input class="form-control" type="text" id="session-price">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="button" id="submit-session" class="btn btn-primary">Готово</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Добавление зала -->
            <div class="modal fade" id="add-genre" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Добавление фильма</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group" id="list">
                                    <label for="genre-name">Название жанра</label>
                                    <input type="text" class="form-control" id="genre-name"
                                           placeholder="Введите название жанра...">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="button" id="submit-genre" class="btn btn-primary">Готово</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="input-group">
                <select class="custom-select" id="select-essence">
                    <option value="1" selected>Сеанс</option>
                    <option value="2">Фильм</option>
                    <option value="3">Жанр</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" id="submit-essence" type="button">Добавить</button>
                </div>
            </div>
            <br>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab"
                       aria-controls="order" aria-selected="true">Заказы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="film-tab" data-toggle="tab" href="#film" role="tab"
                       aria-controls="film" aria-selected="false">Фильмы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="session-tab" data-toggle="tab" href="#session" role="tab"
                       aria-controls="session" aria-selected="false">Сеансы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="genre-tab" data-toggle="tab" href="#genre" role="tab"
                       aria-controls="genre" aria-selected="false">Жанры</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <!-- Иформация о заказах для аминистратора -->
                <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
                    <table class="table">
                        <thead>
                        <tr class="table-active">
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Фильма</th>
                            <th scope="col">Ряд</th>
                            <th scope="col">Место</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;
                        foreach ($orderList as $orderItem): ?>
                            <tr>
                                <th scope="row"><?php echo ++$i; ?></th>
                                <td><?php echo $orderItem['email']; ?></td>
                                <td><?php echo $orderItem['name']; ?></td>
                                <td><?php echo $orderItem['row']; ?></td>
                                <td><?php echo $orderItem['place']; ?></td>
                                <td><?php echo ($orderItem['status'] == 'expects') ? 'В ожидании' : ''; ?></td>
                                <td>
                                    <button type="button" id="<?php echo $orderItem['id']; ?>" value="confirm"
                                            class="order-admin-decision btn btn-outline-success">Принять
                                    </button>
                                    <button type="button" id="<?php echo $orderItem['id']; ?>" value="cancel"
                                            class="order-admin-decision btn btn-outline-danger">Отменить
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Иформация о фильмах для аминистратора -->
                <div class="tab-pane fade" id="film" role="tabpanel" aria-labelledby="film-tab">
                    <table class="table">
                        <thead>
                        <tr class="table-active">
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Возраст</th>
                            <th scope="col">Рейтинг</th>
                            <th scope="col">Доступность</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;
                        foreach ($filmList as $film): ?>
                            <tr>
                                <th scope="row"><?php echo ++$i; ?></th>
                                <td><?php echo $film['id']; ?></td>
                                <td><?php echo $film['name']; ?></td>
                                <td><?php echo $film['age']; ?></td>
                                <td><?php echo $film['rating']; ?></td>
                                <td><?php echo ($film['soon'] != '0') ? 'Доступен' : 'Не доступен'; ?></td>
                                <td>
                                    <button value="film" type="button" id="<?php echo $film['id']; ?>"
                                            class="order-admin-decision btn btn-outline-danger delete">Удалить
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Иформация о сеансах для аминистратора -->
                <div class="tab-pane fade" id="session" role="tabpanel" aria-labelledby="session-tab">
                    <table class="table">
                        <thead>
                        <tr class="table-active">
                            <th scope="col">#</th>
                            <th scope="col">Фильм</th>
                            <th scope="col">Зал</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Время</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;
                        foreach ($sessionList as $sessionItem): ?>
                            <tr>
                                <th scope="row"><?php echo ++$i; ?></th>
                                <td><?php echo $sessionItem['film_name']; ?></td>
                                <td><?php echo $sessionItem['hall_name']; ?></td>
                                <td><?php echo $sessionItem['date']; ?></td>
                                <td><?php echo $sessionItem['time']; ?></td>
                                <td><?php echo $sessionItem['price']; ?> грн</td>
                                <td>
                                    <button value="session" type="button" id="<?php echo $sessionItem['id']; ?>"
                                            class="order-admin-decision btn btn-outline-danger delete">Удалить
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Иформация о жанрах для аминистратора -->
                <div class="tab-pane fade" id="genre" role="tabpanel" aria-labelledby="genre-tab">
                    <table class="table" id="admin-list">
                        <thead>
                        <tr class="table-active">
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;
                        foreach ($genreList as $genreItem): ?>
                            <tr>
                                <th scope="row"><?php echo ++$i; ?></th>
                                <td><?php echo $genreItem['name']; ?></td>
                                <td>
                                    <button value="genre" type="button" id="<?php echo $genreItem['id']; ?>"
                                            class="order-admin-decision btn btn-outline-danger delete">Удалить
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php } else { ?>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home" aria-selected="true">Заказы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">Список желаемого</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    Заказы
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <!-- Список-->
                    <div class="row">
                        <div class="col">
                            <table class="table table-sm">
                                <thead>
                                <tr class="table-active">
                                    <th scope="col">#</th>
                                    <th scope="col">Навзвание</th>
                                    <th scope="col">Начало проката</th>
                                    <th scope="col">Конец проката</th>
                                    <th scope="col">Наличие</th>
                                    <th scope="col" colspan="2" style="text-align: center;">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($wishList as $wishFilm): ?>
                                    <tr class="table-<?php echo ($wishFilm['is_available'] == '1') ? 'success' : 'primary'; ?>">
                                        <th scope="row">1</th>
                                        <td><?php echo $wishFilm['name']; ?></td>
                                        <td><?php echo $wishFilm['rent_start']; ?></td>
                                        <td><?php echo $wishFilm['rent_end']; ?></td>
                                        <td><?php echo ($wishFilm['is_available'] == '1') ? 'Доступен' : 'Отсутствует'; ?></td>
                                        <td>
                                            <button <?php echo ($wishFilm['is_available'] == '1') ? '' : 'disabled'; ?>
                                                    value="film" type="button" id="<?php echo $wishFilm['id']; ?>"
                                                    class="order-admin-decision btn btn-outline-danger delete">
                                                Забронировать
                                            </button>
                                        </td>
                                        <td>
                                            <button
                                                    value="film" type="button" id="<?php echo $wishFilm['id']; ?>"
                                                    class="delete-to-wish-list order-admin-decision btn btn-outline-danger delete">Удалить
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>