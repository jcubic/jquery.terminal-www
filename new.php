<?php

if (isset($_POST['username']) && isset($_POST['message'])) {
    require_once('Notifications.php');
    $notification = new Notification();

    $notification->send($_POST['username'], $_POST['message']);
}
