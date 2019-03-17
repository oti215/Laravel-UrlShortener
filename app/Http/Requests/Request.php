<?php

namespace App\Http\Requests;

use App\Helpers\Response;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class Request extends FormRequest {
	public function authorize( ) {
		return true;
	}

	protected function getValidatorInstance( ) {   
		return parent::getValidatorInstance( )->after( function( $validator ) {
			$this->customValidations( );
		} );
	}

	public function customValidations( ){
		#override
	}

	public function failedValidation( Validator $validator ) {
		Response::setError( );

		foreach( $validator->errors( )->all( ) AS $error ) {
			Response::addMessage( $error, 'error' );
		}

		Response::flush( );
	}
}