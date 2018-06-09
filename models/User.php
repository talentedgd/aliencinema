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
        $email_result = $db->prepare("INSERT INTO user(email) VALUES :email");
        $email_result->bindParam(':email', $email, PDO::PARAM_STR);
        $email_result->execute();

        /*$result = $db->prepare("SELECT id FROM user WHERE email = :email");
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        $id = $result->fetch();

        $other_results = $db->prepare("INSERT INTO registered_user(id, name, password) VALUES ($id, :name, :password)");
        $other_results->bindParam(':name', $name, PDO::PARAM_STR);
        $other_results->bindParam(':password', $password, PDO::PARAM_STR);
        $other_results->execute();*/
    }
}