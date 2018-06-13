<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Alien Cinema</title>
    <link rel="stylesheet" type="text/css" href="/template/css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

</head>
<body>

<!-- Навигационное меню -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">
        <div></div> <!-- Пустышка для отступа -->
        <img src="http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Alien-icon.png" id="brand" alt="...">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Фильмы
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/films/current">Сейчас в прокате</a>
                    <a class="dropdown-item" href="/films/future">Скоро в прокате</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/films">Все фильмы</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">О нас</a>
            </li>
        </ul>

        <!-- Форма поиска -->

        <form class="form-inline my-2 my-lg-0" id="search-form" method="post" action="/search">
            <input class="form-control mr-sm-2" type="search" placeholder="Поиск фильмов..." name="search_query"
                   aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
        </form>

        <!-- Форма входа -->

        <div class="dropdown navbar-nav">
            <button class="btn dropdown-toggle btn-secondary" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if (!isset($_SESSION['user_id'])) echo 'Вход на сайт / Регистрация'; else echo User::getUserEmailBySession(); ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right col-lg-12" aria-labelledby="dropdownMenuButton">
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <form class="p-4">
                        <div class="form-group">
                            <label>Запоните форму</label>
                            <input type="email" class="form-control login_email" id="exampleDropdownFormEmail2"
                                   placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control login_password" id="exampleDropdownFormPassword2"
                                   placeholder="Пароль">
                        </div>
                        <button type="submit" 0 id="login" name="login" class="btn btn-primary">Войти</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalCenter">
                            Регистрация
                        </button>
                    </form>
                <?php } else { ?>
                    <a class="dropdown-item" href="/profile">Мой профиль</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="" id="logout">Выход</a>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
</nav>

<!-- Модальное окно для регистрации -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="email_value">Введите Email</label>
                        <p class="email_conclusion conclusion">asdfasdf</p>
                        <input type="email" class="form-control" id="email_value" aria-describedby="emailHelp"
                               placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="name_value">Введите свое имя</label>
                        <p class="name_conclusion conclusion">asdfasdf</p>
                        <input type="text" class="form-control" id="name_value" placeholder="Имя">
                    </div>
                    <div class="form-group">
                        <label for="password_value">Введите пароль</label>
                        <p class="password_conclusion conclusion">asdfasdf</p>
                        <input type="password" class="form-control" id="password_value" placeholder="Пароль">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="hide" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" id="registration" class="btn btn-primary">Готово</button>
            </div>
        </div>
    </div>
</div>


