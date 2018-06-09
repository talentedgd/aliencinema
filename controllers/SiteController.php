<?php

class SiteController
{
    /* Метод для перехода на страницу "О нас" */
    public function actionAbout()
    {

        require_once(ROOT . '/views/site/about.php');

        return true;
    }
}