<?php
require_once('user_session.php');
$signout = new userSession();
$signout->endSession();

echo "sign out successful";

header("Location: http://localhost/Contestant-Statistics-Management-System/");

?>