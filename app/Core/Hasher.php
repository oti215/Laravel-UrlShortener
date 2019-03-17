<?php

namespace App\Core;

use App\Core\Interfaces\IdHasher;

final class Hasher extends IdHasher {

	public static function hash( $id ) {

		$hashid = self::getHashidInstance( );

		return $hashid->encode( $id );

	}

}