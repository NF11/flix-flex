<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;

class LoginSuccessResponse implements Responsable
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function toResponse($request)
    {
        // Create new token
        $token = $this->user->createToken('Authentication');
        return response([
            'token_type' => 'Bearer',
            'access_token' => $token->plainTextToken,
            'expires_in' => (int)config('sanctum.expiration') * 60, // converts to seconds
        ]);
    }
}
