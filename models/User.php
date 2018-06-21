<?php

class User
{
    /* Проверить есть в списке желаемого данго юзера фильм */
    public static function checkWishList($film_id)
    {
        $db = Db::getConnection();
        $id = $_SESSION['user_id'];
        $result = $db->query("SELECT film_id FROM wish_list WHERE registered_user_id = $id");
        $i = 0;
        while ($row = $result->fetch()) {
            if ($row['film_id'] == $film_id) {
                return true;
            }
            $i++;
        }
        return false;
    }

    /* Удалить фильм из списка желаемого*/
    public static function deleteWishList($id)
    {
        $user_id = $_SESSION['user_id'];
        $db = Db::getConnection();
        if ($db->query("DELETE FROM wish_list WHERE registered_user_id = $user_id AND film_id = $id")) return true;
        return false;
    }

    /* Добавить в список желаемого фильм */
    public static function addWishList($id)
    {
        $user_id = $_SESSION['user_id'];
        $db = Db::getConnection();
        if ($db->query("INSERT INTO wish_list(registered_user_id, film_id) VALUES ($user_id, $id)")) return true;
        return false;
    }

    /* Изменение парояля */
    public static function changePassword($oldPassword, $newPassword, $repPassword)
    {
        $db = Db::getConnection();
        $id = $_SESSION['user_id'];
        $result = $db->query("SELECT password FROM registered_user WHERE id = $id");
        $pass = $result->fetch();
        if (($pass['password'] == $oldPassword) && ($newPassword == $repPassword)) {
            $db->query("UPDATE registered_user SET password = '$newPassword' WHERE id = '$id'");
            return true;
        }
        return false;
    }

    /* Полчемение списка желаемых фильмов */
    public static function getWishList()
    {
        $db = Db::getConnection();
        $id = $_SESSION['user_id'];
        $result = $db->query("SELECT  film.id, film.name, film.rent_start, film.rent_end, film.is_available FROM film, wish_list WHERE wish_list.registered_user_id = $id AND wish_list.film_id = film.id");
        $i = 0;
        $wishList = array();
        while ($row = $result->fetch()) {
            $wishList[$i]['id'] = $row['id'];
            $wishList[$i]['name'] = $row['name'];
            $wishList[$i]['rent_start'] = $row['rent_start'];
            $wishList[$i]['rent_end'] = $row['rent_start'];
            $wishList[$i]['rent_end'] = $row['rent_end'];
            $wishList[$i]['is_available'] = $row['is_available'];
            $i++;
        }
        if (count($wishList)) {
            return $wishList;
        }
        return false;
    }

    /* Проверяет админ ли пользователь */
    public static function userIsAdmin()
    {
        if (isset($_SESSION['user_id'])) {
            $db = Db::getConnection();
            $result = $db->query('SELECT is_admin FROM registered_user WHERE id=' . $_SESSION['user_id']);
            $result = $result->fetch();
            if ($result['is_admin'] == 1) return true;
        }
        return false;
    }

    /* Метод получения имени авторизованого пользователя */
    public
    static function getUserNameBySession()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT name FROM registered_user WHERE id=' . $_SESSION['user_id']);
        $result = $result->fetch();
        return $result['name'];
    }

    /* Мтод получения email авторизованого пользователя*/
    public
    static function getUserEmailBySession()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT email FROM user WHERE id=' . $_SESSION['user_id']);
        $result = $result->fetch();
        return $result['email'];
    }

    /* Метод входа */
    public
    static function checkDataLogin($email, $password)
    {
        $db = Db::getConnection();
        $result = $db->prepare('SELECT user.id, registered_user.password FROM user, registered_user WHERE user.email = :email AND user.id = registered_user.id');
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        $result = $result->fetch();
        if ($result['password'] == $password) {
            return (int)$result['id'];
        }
        return false;
    }

    /* Метод проверки имени */
    public
    static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /* Метод проверки пароля */
    public
    static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /* Проверяет на валидность введенный незарегестрированым пользователем  email */
    public static function checkEmailValid($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $db = Db::getConnection();
            $result = $db->prepare("SELECT id FROM user WHERE email=:email");
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->execute();
            if ($row = $result->fetch()) {
                $id = (int)$row['id'];
                $resultRegUser = $db->query("SELECT name FROM registered_user WHERE id=$id");
                if ($resultRegUser->fetch()) {
                    return false;
                }
                return true;
            }
            return true;
        }
        return false;
    }

    /* Метод проверки email */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $db = Db::getConnection();
            $result = $db->prepare('SELECT email FROM user WHERE email = :email');
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->execute();
            if ($result->fetch()) {
                $result = $db->prepare('SELECT id FROM registered_user, user WHERE registered_user.id = user.id AND user.email = :email');
                $result->bindParam(':email', $email, PDO::PARAM_STR);
                $result->execute();
                if ($result->fetch()) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /* Метод добавления пользователя */
    public
    static function addUser($email, $name, $password)
    {
        $db = Db::getConnection();
        $email_result = $db->prepare('INSERT INTO user(email) VALUES (:email)');
        $email_result->bindParam(':email', $email, PDO::PARAM_STR);
        $email_result->execute();


        $userId = $db->lastInsertId();

        $result = $db->prepare("INSERT INTO registered_user(id, name, password) VALUES ($userId,:name,:password)");
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();


    }
}