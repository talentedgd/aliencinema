<?php
require_once ROOT . '/models/Films.php';

class UserController
{
    /* Метд для изменения пароля */
    public function actionChangePassword()
    {
        $oldPassword = "";
        $newPassword = "";
        $repPassword = "";
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $repPassword = $_POST['repPassword'];
        if (User::changePassword($oldPassword, $newPassword, $repPassword)) echo 'Пароль успешно изменен!';
        else echo 'Данные введены не неверно!';
    }

    /* Наполняет страницу профиля*/
    public function actionProfile()
    {
        if (isset($_SESSION['user_id'])) {

            $orderList = Films::getOrderList();
            $filmList = Films::getFilmList();
            $sessionList = Films::getSessionList();
            $genreList = Films::getGenreList();

            if (!User::userIsAdmin()) {
                $wishList = User::getWishList();
            }

            include_once ROOT . '/views/site/profile.php';
        } else echo "Ошибка";
    }

    /* Метод выхода из профиля */
    public function actionLogoutAjax()
    {
        unset($_SESSION['user_id']);
    }

    /* Метод входа на сайт (ассинхронный запрос) */
    public function actionLoginAjax()
    {
        $email = '';
        $password = '';
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userId = User::checkDataLogin($email, $password);

        if (is_int($userId)) {
            $_SESSION['user_id'] = $userId;
            echo 'Авторизация выполнена успешно';
        } else echo 'Не верно введены данные';
    }

    /* Метод регистрации (ассинхронный запрос) */
    public function actionRegisterAjax()
    {
        $name = '';
        $email = '';
        $password = '';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = false;

        if (!User::checkEmail($email)) {
            $errors[] = "email"; //"Неправильно введен Email";
        }

        if (!User::checkName($name)) {
            $errors[] = "name"; //"Имя не должно быть короче 2 символов";
        }

        if (!User::checkPassword($password)) {
            $errors[] = "password"; //"Пароль не должен быть короче 6-ти символов";
        }

        if (!$errors) {
            User::addUser($email, $name, $password);
            echo 0;
        } else {
            echo json_encode($errors);
        }
    }
}