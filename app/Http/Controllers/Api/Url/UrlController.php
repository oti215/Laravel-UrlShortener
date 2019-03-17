<?php

namespace App\Http\Controllers\Api\Url;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\Response;
use App\Repositories\UrlRepository;
use App\Http\Requests\Api\Url\CreateShortUrlRequest;

class UrlController extends Controller
{
	
	public function createShortUrl( CreateShortUrlRequest $request ){

		$createdUrl = UrlRepository::createShortUrl( $request );

		if ( $createdUrl ) {
			Response::setOk( );
			Response::addMessage( 'Short url created succesfully' , 'ok' );
			Response::addParam( 'shortUrl' , env( 'APP_URL' ) . '/' . $createdUrl->hash );
		}

		Response::flush( );
	}
    
	public function getMostVisited( ){
		
		$mostVisitedUrls = UrlRepository::getMostVisited( );

		if ( count( $mostVisitedUrls ) ) {
			Response::addParam( 'most_visited' , $mostVisitedUrls );
		}else{
			Response::addMessage( 'There are no visited urls yet!' , 'error' );
		}

		Response::flush( );
	}


	public function getRedirectToFullUrl( Request $request, $hash ){
		
		$url = UrlRepository::getUrlByHash( $hash );

		if ( $url ) {

			$incrementedVisit = UrlRepository::incrementVisits( $url->id );

			if ( $incrementedVisit ) {
				return redirect()->to( $url->original );
			}else{
				Response::addMessage( 'Error registering visit to this short url, please try again' , 'error' );
			}
		}else{
			Response::addMessage( 'This is not a valid short url!' , 'error' ); 
		}

		Response::flush( );
	}
}
