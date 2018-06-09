<?php
include_once ROOT . '/models/User.php';

class UserController
{
    public function actionRegisterAjax()
    {
        $name = '';
        $email = '';
        $password = '';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = false;

        if (User::checkEmail($email)) {

        } else {
            $errors[] = "email"; //"Неправильно введен Email";
        }

        if (User::checkName($name)) {

        } else {
            $errors[] = "name"; //"Имя не должно быть короче 2 символов";
        }

        if (User::checkPassword($password)) {

        } else {
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