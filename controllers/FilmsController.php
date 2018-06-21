<?php

include_once ROOT . '/models/Films.php';

class FilmsController
{
    /* Добавить сущность (фильм, сеанс, жанр) */
    public function actionAddEssence($target)
    {
        if ($target == 'film') {
            $genres = json_decode($_POST['genres']);
            $filmName = strip_tags(trim($_POST['filmName']));
            $filmAge = (int)strip_tags(trim($_POST['filmAge']));
            $filmOriginalName = strip_tags(trim($_POST['filmOriginalName']));
            $filmProducer = strip_tags(trim($_POST['filmProducer']));
            $filmRentStart = strip_tags(trim($_POST['filmRentStart']));
            $filmRentEnd = strip_tags(trim($_POST['filmRentEnd']));
            $filmRating = (float)strip_tags(trim($_POST['filmRating']));
            $filmLanguage = strip_tags(trim($_POST['filmLanguage']));
            $filmDuration = strip_tags(trim($_POST['filmDuration']));
            $filmProduction = strip_tags(trim($_POST['filmProduction']));
            $filmScenario = strip_tags(trim($_POST['filmScenario']));
            $filmStarring = strip_tags(trim($_POST['filmStarring']));
            $isAvailable = (int)(strip_tags(trim($_POST['isAvailable'] == 'on') ? 1 : 0));
            $filmTrailer = strip_tags(trim($_POST['filmTrailer']));
            $filmDescription = strip_tags(trim($_POST['filmDescription']));
            $isImportant = (int)(strip_tags(trim($_POST['isImportant'] == 'on') ? 1 : 0));
            if (Films::addFilm($genres, $filmName, $filmAge, $filmOriginalName, $filmProducer, $filmRentStart, $filmRentEnd, $filmRating, $filmLanguage, $filmDuration, $filmProduction, $filmScenario, $filmStarring, $filmDescription, $filmTrailer, $isAvailable, $isImportant))
                echo 'Фильм успешно добавлен!';
            else echo 'Данные введены не корректно!';
        } elseif ($target == 'session') {
            $filmId = (int)strip_tags(trim($_POST['filmId']));
            $hallId = (int)strip_tags(trim($_POST['hallId']));
            $sessionDate = strip_tags(trim($_POST['sessionDate']));
            $sessionTime = strip_tags(trim($_POST['sessionTime']));
            $sessionPrice = (float)strip_tags(trim($_POST['sessionPrice']));
            if (Films::addSession($filmId, $hallId, $sessionDate, $sessionTime, $sessionPrice))
                echo 'Сеанс успешно добавлен!';
            else echo 'Данные введены не корректно!';
        } else {
            $genreName = strip_tags(trim($_POST['genreName']));
            if (Films::addGenre($genreName))
                echo 'Жанр успешно добавлен!';
            else echo 'Такой жанр уже существует!';
        }
    }

    /* Удаление жанра */
    public function actionDeleteGenreAjax()
    {
        $id = 0;
        $id = $_POST['id'];
        Films::deleteGenre($id);
    }

    /* Удаление сеанса */
    public function actionDeleteSessionAjax()
    {
        $id = 0;
        $id = $_POST['id'];
        Films::deleteSession($id);
    }

    /* Удаление фильма */
    public function actionDeleteFilmAjax()
    {
        $id = 0;
        $id = $_POST['id'];
        echo $id;
        Films::deleteFilm($id);
    }

    /* Метод который получает искомые фильмы */
    public function actionSearch()
    {
        $films = array();
        $search_query = "";
        $search_query = $_POST['search_query'];
        $films = Films::getWantedFilms($search_query);

        require_once(ROOT . '/views/site/films/index.php');
    }

    /* Метод который получает трендовые фильмы для отображения на гравной страницы */
    public function actionIndex()
    {
        $films = array();
        $films = Films::getTrendFilms();

        require_once(ROOT . '/views/site/index.php');
    }

    /* Метод для получения списка всех фильмов */
    public function actionAll()
    {
        $films = array();
        $films = Films::getFilmList();

        require_once(ROOT . '/views/site/films/index.php');
    }

    /* Метод для получения фильмов, которые уже есть в наличии */
    public function actionCurrent()
    {
        $films = array();
        $films = Films::getCurrentList();
        require_once(ROOT . '/views/site/films/index.php');
    }

    /* Метод для получения фильмов, которых еще нету в наличии*/
    public function actionFuture()
    {
        $films = array();
        $films = Films::getFutureList();

        require_once(ROOT . '/views/site/films/index.php');
    }

    /* Метод для получения информации о фильме */
    public function actionInfo($parameters)
    {
        $filmInfo = Films::getFilmInfo($parameters);
        $todaySessionList = Films::getOrderDataToday($filmInfo['id'], date('Y-m-d'));
        $tomorrowSessionList = Films::getOrderDataToday($filmInfo['id'], date("Y-m-d", strtotime("+1 day")));
        $tomorrowSessionList2 = Films::getOrderDataToday($filmInfo['id'], date("Y-m-d", strtotime("+2 day")));
        $tomorrowSessionList3 = Films::getOrderDataToday($filmInfo['id'], date("Y-m-d", strtotime("+3 day")));
        $tomorrowSessionList4 = Films::getOrderDataToday($filmInfo['id'], date("Y-m-d", strtotime("+4 day")));
        require_once(ROOT . '/views/site/films/film-info.php');
    }
}