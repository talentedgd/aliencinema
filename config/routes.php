<?php

return array(
    'search' => 'films/search',
    'about' => 'site/about',
    'ajax/registration' => 'user/registerAjax',
    'films/([0-9]+)' => 'films/info/$1', // actionInfo в FilmController
    'films/current' => 'films/current', // actionCurrent в FilmController
    'films/future' => 'films/future', // actionFuture в FilmController
    'films' => 'films/all', // actionIndex в FilmController
    '' => 'films/index', // actionIndex в SiteController

);