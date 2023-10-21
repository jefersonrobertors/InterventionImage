<?php

declare(strict_types=1);

namespace app\utils;

use app\models\User;
use app\utils\Session;

final class Auth {

    private Session $session;

    public function __construct()
    {
        $this->session = new Session;
    }

    public function isAuthenticated() : bool {
        return $this->session->hasSession('auth');
    }

    public function authenticate(User $user) {
        if($this->session->hasSession('auth')) return;

        $authSession = new \stdClass;
        $authSession->id = $user->id;
        $authSession->firstName = $user->firstName;
        $authSession->lastName = $user->lastName;
        $authSession->fullName = $user->firstName . ' ' . $user->lastName;

        $this->session->setSession('auth', $authSession);
    }

    public function deauth() : void {
        if($this->session->hasSession('auth')) {
            $this->session->removeSession('auth');
        }
    }
}
?>