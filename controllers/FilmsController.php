<?php

include_once ROOT . '/models/Films.php';

class FilmsController
{
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
        $filmInfo = Films::getFilmInfo($parameters[0]);
        require_once(ROOT . '/views/site/films/film-info.php');
    }
}