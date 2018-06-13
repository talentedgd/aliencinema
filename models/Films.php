<?php

class Films
{
    /* Резервное изображение */
    const DEFAULT_IMAGE = '/template/img/empty_image.jpg';

    /* Добавление фильма */
    public static function addFilm($filmName, $filmAge, $filmOriginalName, $formProducer, $filmRentStart, $filmEndStart, $filmRating, $filmLanguage, $filmProduction, $filmScenario, $filmStarring, $filmDescription, $filmTrailer, $isAvailable, $isImportant)
    {
        $db = Db::getConnection();
        $result = $db->prepare("INSERT INTO film(name, age, original_name, producer, rent_start, rent_end, rating, language, duration, production, scenario, starring, is_available, trailer, description, is_important) VALUES :filmName, :filmAge, :filmOriginalName, :formProducer, :filmRentStart, :filmEndStart, :filmRating, :filmLanguage, :filmProduction, :filmScenario, :filmStarring, :filmDescription, :filmTrailer, :isAvailable, :isImportant");
        $result->bindParam(':filmName', $filmName, PDO::PARAM_STR);
        $result->bindParam(':filmAge', $filmAge, PDO::PARAM_STR);
        $result->bindParam(':filmOriginalName', $filmOriginalName, PDO::PARAM_STR);
        $result->bindParam(':formProducer', $formProducer, PDO::PARAM_STR);
        $result->bindParam(':filmRentStart', $filmRentStart, PDO::PARAM_STR);
        $result->bindParam(':filmEndStart', $filmEndStart, PDO::PARAM_STR);
        $result->bindParam(':filmRating', $filmRating, PDO::PARAM_STR);
        $result->bindParam(':filmLanguage', $filmLanguage, PDO::PARAM_STR);
        $result->bindParam(':filmProduction', $filmProduction, PDO::PARAM_STR);
        $result->bindParam(':filmScenario', $filmScenario, PDO::PARAM_STR);
        $result->bindParam(':filmStarring', $filmStarring, PDO::PARAM_STR);
        $result->bindParam(':filmDescription', $filmDescription, PDO::PARAM_STR);
        $result->bindParam(':filmTrailer', $filmTrailer, PDO::PARAM_STR);
        $result->bindParam(':isAvailable', $isAvailable, PDO::PARAM_STR);
        $result->bindParam(':isImportant', $isImportant, PDO::PARAM_STR);
        $result->execute();
    }

    public static function deleteGenre($id)
    {
        $db = Db::getConnection();
        $db->query("DELETE FROM genre WHERE id = $id");
    }

    public static function deleteSession($id)
    {
        $db = Db::getConnection();
        $db->query("DELETE FROM session WHERE id = $id");
    }

    public static function deleteFilm($id)
    {
        $db = Db::getConnection();
        $db->query("DELETE FROM film WHERE id = $id");
    }

    /* Получение значений времени для формы */
    public static function getTimeList()
    {
        $date = "";
        $id = "";
        $date = $_POST['date'];
        $id = $_POST['id'];

        $db = Db::getConnection();
        $result = $db->query("SELECT time FROM session WHERE film_id=$id AND date=$date");
        $i = 0;
        while ($row = $result->fetch()) {
            $result[$i] = $row['time'];
            $i++;
        }
        return json_encode($result);
    }

    /* Получить список жанров */
    public static function getGenreList()
    {
        $db = Db::getConnection();
        $sessionList = array();
        $result = $db->query('SELECT * FROM genre');
        $i = 0;

        if (!empty($result)) {
            while ($row = $result->fetch()) {
                $sessionList[$i]['id'] = $row['id'];
                $sessionList[$i]['name'] = $row['name'];
                $i++;
            }
            return $sessionList;
        }
        return false;
    }

    /* Получить список сеансов */
    public static function getSessionList()
    {
        $db = Db::getConnection();
        $sessionList = array();
        $result = $db->query('SELECT session.id, film.name, hall.name, session.date,session.time, session.price FROM session, film, hall WHERE film.id=session.film_id AND hall.id=session.hall_id');
        $i = 0;

        if (!empty($result)) {
            while ($row = $result->fetch()) {
                $sessionList[$i]['id'] = $row['id'];
                $sessionList[$i]['film_name'] = $row['name'];
                $sessionList[$i]['hall_name'] = $row['name'];
                $sessionList[$i]['date'] = $row['date'];
                $sessionList[$i]['time'] = $row['time'];
                $sessionList[$i]['price'] = $row['price'];
                $i++;
            }
            return $sessionList;
        }
        return false;
    }

    /* Получить список заказов */
    public static function getOrderList()
    {
        $db = Db::getConnection();
        $orderList = array();
        $result = $db->query('SELECT booking.id, user.email, film.name, booking.row, booking.place, booking.status FROM user,film,booking,session WHERE user.id = booking.user_id AND session.id=booking.session_id AND film.id=session.id');
        $i = 0;

        if (!empty($result)) {
            while ($row = $result->fetch()) {
                $orderList[$i]['id'] = $row['id'];
                $orderList[$i]['email'] = $row['email'];
                $orderList[$i]['name'] = $row['name'];
                $orderList[$i]['row'] = $row['row'];
                $orderList[$i]['place'] = $row['place'];
                $orderList[$i]['status'] = $row['status'];
                $i++;
            }
            return $orderList;
        }
        return false;
    }

    /* Метод возвращает искомые фильмы */
    public static function getWantedFilms($search_query)
    {
        $db = Db::getConnection();

        $filmsList = array();
        $sql = 'SELECT id, name, age, rating, is_available FROM film WHERE name LIKE ?';
        $result = $db->prepare($sql);
        $result->execute(array("%$search_query%"));

        $i = 0;
        if (!empty($result)) {
            while ($row = $result->fetch()) {
                $id = $row['id'];
                $filmsList[$i]['id'] = $id;
                $filmsList[$i]['name'] = $row['name'];
                $filmsList[$i]['rating'] = $row['rating'];
                $filmsList[$i]['age'] = $row['age'];
                $filmsList[$i]['soon'] = $row['is_available'];
                $filmsList[$i]['image'] = self::getPictureById($id);

                $i++;
            }
        }
        return $filmsList;
    }

    /* Метод возвращает трендовые фильмы */
    public static function getTrendFilms()
    {
        $db = Db::getConnection();

        $filmsList = array();

        $result = $db->query('SELECT id, name FROM film WHERE is_important = 1');
        $i = 0;

        while ($row = $result->fetch()) {
            $id = $row['id'];
            $filmsList[$i]['id'] = $id;
            $filmsList[$i]['name'] = $row['name'];
            $filmsList[$i]['image'] = self::getPictureById($id);

            $i++;
        }

        return $filmsList;
    }

    /* Метод возвращает все фильмы с коротким описанием */
    public static function getFilmList()
    {
        $db = Db::getConnection();

        $filmList = array();

        $result = $db->query('SELECT id, name, rating, age, is_available FROM film');
        $i = 0;

        while ($row = $result->fetch()) {
            $id = $row['id'];
            $filmList[$i]['id'] = $id;
            $filmList[$i]['name'] = $row['name'];
            $filmList[$i]['rating'] = $row['rating'];
            $filmList[$i]['age'] = $row['age'];
            $filmList[$i]['image'] = self::getPictureById($id);
            $filmList[$i]['soon'] = $row['is_available'];

            $i++;
        }

        return $filmList;
    }

    /* Метод возвращает все текущие фильмы */
    public static function getCurrentList()
    {
        $db = Db::getConnection();

        $filmsList = array();

        $result = $db->query('SELECT id, name, age, rating FROM film WHERE is_available = 1');
        $i = 0;
        while ($row = $result->fetch()) {
            $id = $row['id'];
            $filmsList[$i]['id'] = $id;
            $filmsList[$i]['name'] = $row['name'];
            $filmsList[$i]['rating'] = $row['rating'];
            $filmsList[$i]['age'] = $row['age'];
            $filmsList[$i]['image'] = self::getPictureById($id);

            $i++;
        }
        return $filmsList;
    }

    /* Метод возвращает все фильмы, которых еще нету */
    public static function getFutureList()
    {
        $db = Db::getConnection();

        $filmsList = array();

        $result = $db->query('SELECT id, name, age, rating, is_available FROM film WHERE is_available = 0');
        $i = 0;
        while ($row = $result->fetch()) {
            $id = $row['id'];
            $filmsList[$i]['id'] = $id;
            $filmsList[$i]['name'] = $row['name'];
            $filmsList[$i]['rating'] = $row['rating'];
            $filmsList[$i]['age'] = $row['age'];
            $filmsList[$i]['image'] = self::getPictureById($id);
            $filmsList[$i]['soon'] = $row['is_available'];

            $i++;
        }
        return $filmsList;
    }

    /* Метод возвращает полную информацию об одном фильме по id*/
    public static function getFilmInfo($id)
    {
        $db = Db::getConnection();
        $result = $db->prepare('SELECT * FROM film WHERE id = :id');
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result = $result->fetch();

        $result['image'] = self::getPictureById($id);

        $genreResult = $db->prepare('SELECT name FROM genre WHERE id IN (SELECT genre_id FROM film_genre WHERE film_id = :id)');
        $genreResult->bindParam(':id', $id, PDO::PARAM_INT);
        $genreResult->execute();
        $genreList = "";
        while ($row = $genreResult->fetch()) {
            $genreList .= $row['name'] . ', ';
        }
        $result['genres'] = substr($genreList, 0, strlen($genreList) - 2);
        $filmId = $result['id'];
        $dateList = $db->query("SELECT date FROM session WHERE film_id = $filmId");

        $i = 0;
        while ($row = $dateList->fetch()) {
            $result['dates'][$i] = $row['date'];
            $i++;
        }


        return $result;
    }

    /* Метод возвращает массив изображений для фильма по id*/
    private static function getPictureById($filmId)
    {
        $folder = '/uploads/films/' . $filmId;

        if (file_exists(ROOT . $folder)) {
            $files = scandir(ROOT . $folder);
            array_shift($files);
            array_shift($files);
            if (count($files) > 0) {
                $i = 0;

                foreach ($files as $file) {
                    $files[$i++] = $folder . '/' . $file;
                }

                return $files;
            }
        }

        return [self::DEFAULT_IMAGE];
    }
}