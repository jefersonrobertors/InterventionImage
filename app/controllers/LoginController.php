<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\User;
use app\services\CsfrService;

final class LoginController extends Controller {

    public function auth() : void {
        if(isset($_POST['email'], $_POST['password'])) {
            $email = trim(strip_tags($_POST['email']));
            $password = trim(strip_tags($_POST['password']));

            if(empty($email)) {
                header('Location: /?error=Field email must be not empty');
                exit;
            }

            if(empty($password)) {
                header('Location: /?error=Field password must be not empty');
                exit;
            }

            if(CsfrService::isValidToken()) {
                CsfrService::destroyToken();
    
                $user = new User;
                $user = $user->login($email, $password);
                if(!$user) {
                    header('Location: /?error=Incorrect email or password');
                    exit;
                }
                global $auth;
                $auth->authenticate($user);

                header('Location: /private');
            }else{
                header('Location: /');
            }
        }
    }

    public function deauth() : void {
        global $auth;
    
        if($auth->isAuthenticated()) {
            $auth->deauth();
        }
        header('Location: /');
    }
}
?>