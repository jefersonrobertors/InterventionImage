<?php

declare(strict_types=1);

namespace app\controllers;

final class PrivateController extends Controller {

    public function main() : void {
        global $auth;
        if(!$auth->isAuthenticated()) {
            header('Location: /');
            exit;
        }
        $this->view('private');
    }
}
?>