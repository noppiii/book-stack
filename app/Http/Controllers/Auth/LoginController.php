<?php

namespace App\Http\Controllers\Auth;

use App\Config\Auth\SocialDriverManager;
use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;

class LoginController extends Controller
{
    use ThrottlesLogins;

    public function __construct(protected SocialDriverManager $socialDriverManager, protected LoginService $loginService,)
    {
        $this->middleware('guest', ['only' => ['getLogin', 'login']]);
        $this->middleware('guard:standard,ldap', ['only' => ['login']]);
        $this->middleware('guard:standard,ldap,oidc', ['only' => ['logout']]);
    }
}
