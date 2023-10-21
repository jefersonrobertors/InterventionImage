<?php

declare(strict_types=1);

namespace app\controllers;

final class HomeController extends Controller {

    public function main() : void {
        global $auth;
        if($auth->isAuthenticated()) {
            header('Location: /private');
            exit;
        }
        $this->view('home');
    }
}
?>