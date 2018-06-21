<?php
require_once ROOT . '/models/Order.php';

class OrderController
{

    /* Метод для принятия заказов */
    public function actionAccessAdmin()
    {
        $bookingId = (int)$_POST['id'];
        if (Order::accessOrderAdmin($bookingId)) echo 'Заказ принят';
    }

    /* Метод для отклонения заказа (администартор) */
    public function actionCancelAdmin()
    {
        $bookingId = (int)$_POST['id'];
        if (Order::cancelOrderAdmin($bookingId)) echo 'Отказано в заказе';
    }

    /* Метод для отмены заказа */
    public function actionCancel()
    {
        $bookingId = (int)$_POST['id'];
        if (Order::cancelOrder($bookingId)) echo 'Заказ отменен';
    }

    /* Метод создания заказа */
    public function actionBooking()
    {
        (int)$sessionId = $_POST['session'];
        (int)$hallId = $_POST['hall'];
        $sits = $_POST['sits'];
        $sits = json_decode($sits);
        if (!empty($sits)) {
            if (!isset($_SESSION['user_id'])) {
                $email = $_POST['email'];
                if (User::checkEmailValid($email)) {
                    Order::addSits($sits, $email, $sessionId, $hallId);
                    echo 'Заказ отправлен в обработку';
                } else echo 'Неверный email, или такой уже существует';
            } else {
                Order::addSitsRegUser($sits, $sessionId, $hallId);
                echo 'Заказ отправлен в обработку';
            }
        }
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