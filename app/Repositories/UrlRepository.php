<?php

namespace App\Repositories;

use App\Core\Hasher;
use App\Models\Url;

final class UrlRepository {

	public static function createShortUrl( $data ){

		$url = new Url;
		$url->original = $data->url;
		$url->save( );
		$url->hash = Hasher::hash( $url->id );

		return $url->save( ) ? $url : null;
	}

	public static function incrementVisits( $urlId ){
		
		$url = Url::find( $urlId );
		$url->visits++;

		return $url->save( ) ? $url : null;
	}

	public static function getMostVisited( $rows = 100 ){
		return Url::orderBy( 'visits' , 'desc' )->take( $rows )->get( );
	}

	public static function getUrlByHash( $hash ){
		return Url::where( 'hash' , $hash )->first( );
	}

}