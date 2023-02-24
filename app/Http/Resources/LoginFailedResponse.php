<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginFailedResponse implements Responsable
{

    public function toResponse($request): Response
    {
        throw ValidationException::withMessages(['name' => ['Sorry! Wrong username or password!']]);
    }
}
