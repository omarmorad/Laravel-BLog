<?php

namespace App\Http\Requests;

class EditPostRequest extends StorePostRequest
{
    public function authorize()
    {
        return true;
    }
}
