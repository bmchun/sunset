<?php
require_once '../../third_party/vendor/autoload.php';

use JPush\Model as M;
use JPush\JPushClient;
use JPush\Exception\APIConnectionException;
use JPush\Exception\APIRequestException;
$app_key = '74a7874f76fa5eb4e6baa6b3';
$master_secret = 'd50c83278b63a7b004da7364';
$br = '<br/>';
$client = new JPushClient($app_key, $master_secret);
if(!isset($_POST['k']))
	exit;
$msg = $_POST['k'];
$result = $client->push()
->setPlatform(M\all)
->setAudience(M\all)
->setOptions(M\options(123456, null, null, true, 60))
->setNotification(M\notification(M\ios($msg, 'happy', 1, true)))
->send();
echo 'Push Success.' . $br;
echo 'sendno : ' . $result->sendno . $br;
echo 'msg_id : ' .$result->msg_id . $br;
echo 'Response JSON : ' . $result->json . $br;
?>