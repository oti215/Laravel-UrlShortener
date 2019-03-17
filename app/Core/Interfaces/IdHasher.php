<?php

namespace App\Core\Interfaces;

use Hashids\Hashids;

abstract class IdHasher {

	abstract protected static function hash( $id ); //make hash from id

	protected static function getHashidInstance( ){
		return new Hashids( 'salt' , 6 );
	}

}