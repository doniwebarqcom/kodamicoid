<?php 

/**
 * TOKEN
 * @var string
 */
$GLOBALS['token'] = 'n9SqFa1VrNAG6R4i7smR3zvmfwebSH7fRZGxaHsBv2hCUlU1Oh';

function moota_api()
{
	global $token;

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'https://app.moota.co/api/v1/profile');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_HTTPHEADER, [
	    'Accept: application/json',
	    'Authorization: Bearer '. $token
	]);
	$response = curl_exec($curl);
}

/**
 * [moota_mutasi description]
 * @return [type] [description]
 */
function moota_bank()
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'https://app.moota.co/api/v1/bank');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_HTTPHEADER, [
	    'Accept: application/json',
	    'Authorization: Bearer '. $GLOBALS['token']
	]);
	$response = curl_exec($curl);

	return $response;
}

/**
 * [moota_mutasi description]
 * @param  [type] $bank_id [description]
 * @return [type]          [description]
 */
function moota_mutasi($bank_id)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'https://app.moota.co/api/v1/bank/'. $bank_id .'/mutation/');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_HTTPHEADER, [
	    'Accept: application/json',
	    'Authorization: Bearer '. $GLOBALS['token']
	]);
	$response = curl_exec($curl);

	return $response;
}


?>