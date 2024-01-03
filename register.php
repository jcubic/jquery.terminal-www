<?php
/*
 * This file is part of Simple PHP Chat
 * Released under MIT License
 *
 * https://github.com/jcubic/chat/tree/notifications
 *
 * Copyright (c) 2019 Jakub T. Jankiewicz
 */

if (isset($_POST['id']) && isset($_POST['token'])) {
    require_once('Notifications.php');
    $notification = new Notification();

    $notification->register($_POST['id'], $_POST['token']);
}
