<?php

include_once ROOT . '/models/Films.php';

class FilmsController
{
    /* Добавить сущность */
    public function actionAddEssence($target)
    {
        if ($target == 'film') {
            $filmName = $_POST['filmName'];
            $filmAge = $_POST['filmAge'];
            $filmOriginalName = $_POST['filmOriginalName'];
            $formProducer = $_POST['formProducer'];
            $filmRentStart = $_POST['filmRentStart'];
            $filmEndStart = $_POST['filmEndStart'];
            $filmRating = (float)$_POST['filmRating'];
            $filmLanguage = $_POST['filmLanguage'];
            $filmProduction = $_POST['filmProduction'];
            $filmScenario = $_POST['filmScenario'];
            $filmStarring = $_POST['filmStarring'];
            $filmDescription = $_POST['filmDescription'];
            $filmTrailer = $_POST['filmTrailer'];
            $isAvailable = (int)($_POST['isAvailable'] == 'on') ? 1 : 0;
            $isImportant = (int)($_POST['isImportant'] == 'on') ? 1 : 0;
            Films::addFilm($filmName, $filmAge, $filmOriginalName, $formProducer, $filmRentStart, $filmEndStart, $filmRating, $filmLanguage, $filmProduction, $filmScenario, $filmStarring, $filmDescription, $filmTrailer, $isAvailable, $isImportant);
            echo 'fine';
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

    /* Метод который получает трендовые фильмы для гравной страницы */
    public function actionIndex()
    {
        $films = array();
        $films = Films::getTrendFilms();

        require_once(ROOT . '/views/site/index.php');
    }

    /* Метод для получения всех фильмов */
    public function actionAll()
    {
        $films = array();
        $films = Films::getFilmList();

        require_once(ROOT . '/views/site/films/index.php');
    }

    /* Метод для получения фильмов, которые есть в наличии */
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
        require_once(ROOT . '/views/site/films/film-info.php');
    }
}