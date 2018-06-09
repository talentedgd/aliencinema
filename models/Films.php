<?php

class Films
{
    const DEFAULT_IMAGE = '/template/img/empty_image.jpg';

    public static function getWantedFilms($search_query)
    {
        $db = Db::getConnection();

        $filmsList = array();
        $result = $db->query("SELECT id, name, age, rating, is_available FROM film WHERE name LIKE '%" . $search_query . "%'");
        $i = 0;
        if(!empty($result)) {
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

    public static function getFilmList()
    {
        $db = Db::getConnection();

        $filmsList = array();

        $result = $db->query('SELECT id, name, age, rating, is_available FROM film');
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

    public static function getFilmInfo($id)
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM film WHERE id = ' . $id);

        $result = $result->fetch();
        $result['image'] = self::getPictureById($id);

        return $result;
    }


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