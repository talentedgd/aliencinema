<?php

include_once ROOT . '/models/Films.php';

class FilmsController
{
    public function actionSearch()
    {
        $films = array();
        $search_query = "";
        $search_query = $_POST['search_query'];
        $films = Films::getWantedFilms($search_query);

        require_once(ROOT . '/views/site/films/index.php');
    }

    public function actionIndex()
    {
        $films = array();
        $films = Films::getTrendFilms();

        require_once(ROOT . '/views/site/index.php');
    }

    public function actionAll()
    {
        $films = array();
        $films = Films::getFilmList();

        require_once(ROOT . '/views/site/films/index.php');
    }

    public function actionCurrent()
    {
        $films = array();
        $films = Films::getCurrentList();
        require_once(ROOT . '/views/site/films/index.php');
    }

    public function actionFuture()
    {
        $films = array();
        $films = Films::getFutureList();
        require_once(ROOT . '/views/site/films/index.php');
    }

    public function actionInfo($parameters)
    {
        $filmInfo = Films::getFilmInfo($parameters[0]);
        require_once(ROOT . '/views/site/films/film-info.php');
    }
}