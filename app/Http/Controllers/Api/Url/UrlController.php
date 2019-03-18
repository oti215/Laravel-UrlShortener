<?php

namespace App\Http\Controllers\Api\Url;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Helpers\Response;
use App\Repositories\UrlRepository;
use App\Http\Requests\Api\Url\CreateShortUrlRequest;

class UrlController extends Controller
{
	
	public function createShortUrl( CreateShortUrlRequest $request ){

		try{

			DB::beginTransaction( );

			$createdUrl = UrlRepository::createShortUrl( $request );

			if ( $createdUrl ) {
				DB::commit( );
				Response::setOk( );
				Response::addMessage( 'Short url created succesfully for: ' . $createdUrl->original , 'ok' );
				Response::addParam( 'shortUrl' , config( 'app.url' ) . '/' . $createdUrl->hash );
			}

		}catch( Exceptio $e ){
			
		}
		Response::flush( );
	}
    
	public function getMostVisited( $rows = null ){

		$mostVisitedUrls = UrlRepository::getMostVisited( $rows );

		if ( count( $mostVisitedUrls ) ) {
			Response::setOk( );
 			Response::addParam( 'most_visited' , $mostVisitedUrls );
		}else{
			Response::addMessage( 'There are no visited urls yet!' , 'error' );
		}

		Response::flush( );
	}

	public function getRedirectToFullUrl( Request $request, $hash ){
		
		$url = UrlRepository::getUrlByHash( $hash );

		if ( $url ) {

			try{

				DB::beginTransaction( );

				$incrementedVisits = UrlRepository::incrementVisits( $url->id );

				if ( $incrementedVisits ) {
					DB::commit( );
					Response::setOk( ); 
					return redirect()->to( $url->original );
				}

			}catch( Exception $e ){
				Response::addMessage( 'Error registering visit to this short url, please try again' , 'error' );
			}
		}else{
			Response::addMessage( 'This is not a valid short url!' , 'error' ); 
		}

		Response::flush( );
	}
}
