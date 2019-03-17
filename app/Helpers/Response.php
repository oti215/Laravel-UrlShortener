<?php

namespace App\Helpers;

final class Response {

	private static $status = 'error';
	private static $responseMessages = [ ];
	private static $responseData = [ ];

	public static function setOk( ){
		self::$status = 'ok';
	}

	public static function setError( ){
		self::$status = 'error';	
	}

	public static function addMessage( $message , $type = 'ok' ){
		self::$responseMessages[ ] = [ 'message' => $message , 'type' => $type ];
	}

	public static function addParam( $key , $param ){
		self::$responseData[ $key ] = $param; 
	}

	public static function flush( ){
		header('Content-Type: application/json');
		header_remove('Access-Control-Allow-Origin');
		header('Access-Control-Allow-Origin: *');
		die( self::getOutput( ) );
	}

	private static function getOutput( ){
		return json_encode([ 
			'_META'	=> array_merge( [ 'status' => self::$status , 'messages' => self::$responseMessages ] ),
			'_DATA'	=> self::$responseData,
		]);
	}
}