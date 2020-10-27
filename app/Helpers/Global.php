<?php 

/*
* Get Token BY JWT
*/
function GetToken($request)
{
	$header = $request->header('Authorization');	
	$ex = explode(" ", $header);
	$ex2 = explode(".", $ex[1]);
	$base64 = base64_decode($ex2[1]);
	$json = json_decode($base64);
	return $json;
}

/*
* Get Levels
*/
function GetID($request)
{
	$dataToken = GetToken($request);
	return $dataToken->sub->warga_id;
}

?>