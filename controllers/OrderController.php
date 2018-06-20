<?php
require_once ROOT . '/models/Order.php';

class OrderController
{

    /* Метод создания заказа */
    public function actionBooking()
    {
        $email = $_POST['email'];
        (int)$hallId = $_POST['hall'];
        $sits = $_POST['sits'];
        (int)$sessionId = $_POST['session'];
        $sits = json_decode($sits);
        Order::addSits($sits, $email, $sessionId, $hallId);
    }

    /* Выбор сеанса и зала */
    public function actionMakeOrder()
    {
        $session = $_POST['session'];
        $hall = $_POST['hall'];
        $sitsCount = Order::getSitsCount($hall);
        require_once(ROOT . '/views/site/order.php');
    }
}