<?php
require_once '../../third_party/vendor/autoload.php';

use JPush\Model as M;
use JPush\JPushClient;
use JPush\Exception\APIConnectionException;
use JPush\Exception\APIRequestException;

$br = '<br/>';
$app_key = '74a7874f76fa5eb4e6baa6b3';
$master_secret = 'd50c83278b63a7b004da7364';

$client = new JPushClient($app_key, $master_secret);

try {
	$msg_ids = '2969371506';
	$result = $client->report($msg_ids);
	foreach($result->received_list as  $received) {
		echo '---------' . $br;
		echo 'msg_id : ' . $received->msg_id . $br;
		echo 'android_received : ' .  $received->android_received . $br;
		echo 'ios_apns_sent : ' .  $received->ios_apns_sent . $br;
	}
} catch (APIRequestException $e) {
	echo 'Push Fail.' . $br;
	echo 'Http Code : ' . $e->httpCode . $br;
	echo 'code : ' . $e->code . $br;
	echo 'message : ' . $e->message . $br;
	echo 'Response JSON : ' . $e->json . $br;
	echo 'rateLimitLimit : ' . $e->rateLimitLimit . $br;
	echo 'rateLimitRemaining : ' . $e->rateLimitRemaining . $br;
	echo 'rateLimitReset : ' . $e->rateLimitReset . $br;
} catch (APIConnectionException $e) {
	echo 'Push Fail.' . $br;
	echo 'message' . $e->getMessage() . $br;
}


?>