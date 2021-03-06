<?php

/* Маршруты которые обрабатывает Router */
return array(

    /* Подтвердить заказ */
    'ajax/accessOrderAdmin' => 'order/accessAdmin',

    /* Отменить заказ (администратор) */
    'ajax/cancelOrderAdmin' => 'order/cancelAdmin',

    /* Отменить заказ */
    'ajax/cancelOrder' => 'order/cancel',

    /* Сделать заказ */
    'ajax/bookedSits'=>'order/booking',

    /* Сделать заказ */
    'ajax/makeOrder'=>'order/makeOrder',

    /* Удалить фильм из списка желаемого */
    'ajax/deleteToWishList'=>'user/deleteFilmToWishList',

    /* Добавить в список желаемого фильм */
    'ajax/addToWishList'=>'user/addFilmToWishList',

    /* Смена пароля */
    'ajax/change/password' => 'user/changePassword',

    /* Добавить сущность */
    'ajax/add/essence/([a-z]+)' => 'films/addEssence/$1',

    /* Оптимизировать */
    'ajax/delete/genre' => 'films/deleteGenreAjax',
    'ajax/delete/film' => 'films/deleteFilmAjax',
    'ajax/delete/session' => 'films/deleteSessionAjax',

    'profile' => 'user/profile',

    /* Входи, выход */
    'ajax/logout' => 'user/logoutAjax',
    'ajax/login' => 'user/loginAjax',

    'search' => 'films/search',
    'about' => 'site/about',
    'ajax/registration' => 'user/registerAjax',
    'films/([0-9]+)' => 'films/info/$1', // actionInfo в FilmController
    'films/current' => 'films/current', // actionCurrent в FilmController
    'films/future' => 'films/future', // actionFuture в FilmController
    'films' => 'films/all', // actionIndex в FilmController
    '' => 'order/test', // actionIndex в SiteController
    'ajax/delete/films' => 'films/deleteFilmAjax',

);