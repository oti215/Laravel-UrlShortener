<?php

namespace App\Http\Requests\Api\Url;

use App\Http\Requests\Request;

class CreateShortUrlRequest extends Request
{
    public function rules()
    {
        return [
            'url'       => 'required|url|max:191|unique:urls,original',
        ];
    }

    public function messages( ){
        return [
            'url.url'   => 'Invalid url. Tips: Be sure to include the protocol information. Ex: http://, https://, etc...',
            'url.max'   => 'We only shorten urls less than or equal to 191 characters!',
            'url.unique'    => 'This url has already been shortened, please try another url!',
        ];
    }
}
