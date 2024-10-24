<?php
    include("models/User.php");

    $user = new User();
    print_r($user->getInfo());
?>