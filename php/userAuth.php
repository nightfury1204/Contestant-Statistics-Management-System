<?php

require_once('user_session.php');

$userAuth = new userSession();
if($userAuth->userAuthentication())
{
	$res = json_encode(array('auth'=>true,'username'=>$userAuth->userName()), JSON_FORCE_OBJECT);
	echo $res;	
}
else
{
	$res = json_encode(array('auth'=>false,'username'=>""), JSON_FORCE_OBJECT);
	echo $res;
}

?>