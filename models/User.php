<?php

class User
{

    public static function register()
    {

    }

    /* Метод проверки имени */
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /* Метод проверки пароля */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /* Метод проверки email*/
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /* Метод добавления пользователя */
    public static function addUser($email, $name, $password)
    {
        $db = Db::getConnection();
        $db->query("INSERT INTO user(email) VALUE $email");
        $db->query("INSERT INTO registered_user(name, password) VALUES ($name, $password)");
    }
}