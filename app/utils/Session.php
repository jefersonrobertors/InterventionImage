<?php

declare(strict_types=1);

namespace app\utils;

final class Session {

    public function __construct()
    {
        if(!isset($_SESSION)) session_start();
    }

    public function hasSession(string $sessionName) : bool {
        return isset($_SESSION[$sessionName]);
    }    

    public function getSession(string $sessionName,  mixed $defaultValue = null) : mixed {
        return $this->hasSession($sessionName) ? $_SESSION[$sessionName] : $defaultValue;
    }

    public function setSession(string $sessionName, mixed $value) : void {
        $this->removeSession($sessionName);
        $_SESSION[$sessionName] = $value;
    }

    public function removeSession(string $sessionName) : void {
        if($this->hasSession($sessionName)) unset($_SESSION[$sessionName]);
    }
}
?>