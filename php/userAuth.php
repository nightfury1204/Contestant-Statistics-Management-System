<?php

require_once('user_session.php');

$userAuth = new userSession();
echo $userAuth->userAuthentication();

?>