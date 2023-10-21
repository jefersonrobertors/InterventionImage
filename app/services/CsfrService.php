<?php

declare(strict_types=1);

namespace app\services;

final class CsfrService {

    public static function insertHiddenToken() : void {
        global $session;

        $token = md5(uniqid());
        $session->setSession('CSFR_TOKEN_SESSID', $token);

        echo "<input type='hidden' name='token' value='{$token}' />";
    }

    public static function isValidToken() : bool {
        global $session;

        $token = isset($_POST['token']) ? $_POST['token'] : '';

        return $session->getSession('CSFR_TOKEN_SESSID') === $token;
    }

    public static function destroyToken() : void {
        global $session;
        $session->removeSession('CSFR_TOKEN_SESSID');
    }
}
?>