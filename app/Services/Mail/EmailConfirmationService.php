<?php

namespace App\Services\Mail;

use App\Exceptions\ConfirmationEmailException;
use App\Models\User;
use App\Notifications\ConfirmEmailNotification;

class EmailConfirmationService extends UserTokenService
{
    protected string $tokenTable = 'email_confirmation';
    protected int $expiryTime = 24;

    //  Create new confirmation for a user. also removes any existing old ones.
    public function sendConfirmation(User $user): void
    {
        if ($user->email_confirmed) {
            throw new ConfirmationEmailException(trans('errors.email_already_confirmed'), '/login');
        }

        $this->deleteByUser($user);
        $token = $this->createTokenForUser($user);

        $user->notify(new ConfirmEmailNotification($token));
    }
}
