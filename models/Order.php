<?php

class Order
{
    /* Добавить места в бронь */
    public static function addSits($sits, $email, $sessionId, $hallId)
    {
        $db = Db::getConnection();
        $hall = $db->query("SELECT number_of_sits, number_of_rows FROM hall WHERE id = $hallId");
        $hall = $hall->fetch();
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            foreach ($sits as $sit) {
                (int)$row = $sit / $hall['number_of_rows'];
                (int)$place = $sit % $hall['number_of_rows'];
                $db->query("INSERT INTO booking(user_id, session_id, row, place) VALUES ($id, $sessionId, $row, $place)");
            }
        } else {
            $db->query("INSERT INTO user(email) VALUES ('$email')");
            $result = $db->query("SELECT id FROM user WHERE email='$email'");
            $result = $result->fetch();
            $id = $result['id'];
            foreach ($sits as $sit) {
                (int)$row = $sit / $hall['number_of_rows'];
                (int)$place = $sit % $hall['number_of_rows'];
                $db->query("INSERT INTO booking(user_id, session_id, row, place) VALUES ('$id', '$sessionId', '$row', '$place')");
            }

        }


    }

    /* Получить список*/
    public static function getSitsCount($id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT number_of_sits, number_of_rows FROM hall WHERE id=$id");
        $result = $result->fetch();
        return $result;
    }
}