<?php

namespace App\Services\Auth;

use App\Config\Auth\MfaSession;

class LoginService
{
    protected const LAST_LOGIN_ATTEMPTED_SESSION_KEY = 'auth-login-last-attempted';

    public function __construct(protected MfaSession $mfaSession, protected EmailConfirmationService $emailConfirmationService, protected SocialDriverManager $socialDriverManager,)
    {
    }

}
