<?php

class SiteController
{
    public function actionAbout()
    {

        require_once(ROOT . '/views/site/about.php');

        return true;
    }
}