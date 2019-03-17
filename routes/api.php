<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group( [ 'namespace' => 'Api' ] , function( ) { 

	Route::group( [ 'prefix' => 'url' , 'namespace' => 'Url' ] , function( ) { 
		Route::get( '/get_most_visited/{rows?}' , 'UrlController@getMostVisited' );
		Route::post( '/create_short_url' , 'UrlController@createShortUrl' );
	} );

} );