<?php

class Order
{

    /* Метод получения забронированых мест */
    public static function getBookedSits($place, $row, $hall, $session)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT booking.id FROM booking, session WHERE booking.place = $place AND booking.row = $row AND session.hall_id = $hall AND booking.session_id = $session AND booking.status='success'");
        if ($result->fetch()) return false;
        return true;
    }

    /* Принятие заказа (администратор) */
    public static function accessOrderAdmin($id)
    {
        $db = Db::getConnection();
        $db->query("UPDATE booking SET status='success' WHERE id = $id");
        return true;
    }

    /* Отказ в заказе пользователю (администратор) */
    public static function cancelOrderAdmin($id)
    {
        $db = Db::getConnection();
        $db->query("UPDATE booking SET status='canceled' WHERE id = $id");
        return true;
    }

    /* Удаляем отмененный пользователем заказ */
    public static function cancelOrder($id)
    {
        $db = Db::getConnection();
        $db->query("DELETE FROM booking WHERE id = $id");
        return true;
    }

    /* Добавить места в бронь для зарегестрированого пользователя */
    public static function addSitsRegUser($sits, $sessionId, $hallId)
    {
        $db = Db::getConnection();
        $hall = $db->query("SELECT number_of_sits, number_of_rows FROM hall WHERE id = $hallId");
        $hall = $hall->fetch();

        $id = $_SESSION['user_id'];
        foreach ($sits as $sit) {
            $row = 0;
            while ($sit >= $hall['number_of_sits']) {
                $sit -= $hall['number_of_sits'];
                $row++;
            }
            $place = $sit;
            if ($row == 0) $row = 1;
            if ($place == 0) $place = 1;
            $db->query("INSERT INTO booking(user_id, session_id, row, place) VALUES ($id, $sessionId, $row, $place)");
        }
    }

    /* Добавить места в бронь */
    public static function addSits($sits, $email, $sessionId, $hallId)
    {
        $db = Db::getConnection();
        $hall = $db->query("SELECT number_of_sits, number_of_rows FROM hall WHERE id = $hallId");
        $hall = $hall->fetch();

        $resultEmail = $db->prepare("SELECT id FROM user WHERE email = :email");
        $resultEmail->bindParam(':email', $email, PDO::PARAM_STR);
        $resultEmail->execute();
        if ($resultEmail->fetch()) {
            $result = $db->query("SELECT id FROM user WHERE email='$email'");
            $result = $result->fetch();
            $id = $result['id'];
            foreach ($sits as $sit) {
                (int)$row = $sit / $hall['number_of_rows'];
                (int)$place = $sit % $hall['number_of_rows'];
                $db->query("INSERT INTO booking(user_id, session_id, row, place) VALUES ('$id', '$sessionId', '$row', '$place')");
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