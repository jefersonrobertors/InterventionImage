<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\User;
use app\services\CsfrService;
use core\UploadImage;

final class UploadController extends Controller {

    public function main() : void {
        if(CsfrService::isValidToken()) {
            CsfrService::destroyToken();

            $image = new UploadImage;
            $image->make()->resize(200, 300, true)->fit(200)->save();

            $info = $image->info();

            global $session;
            $id = $session->getSession('auth')->id;

            $user = new User;

            if(!empty($old_image)) @unlink(__DIR__ . ($user->find('id', $id)->avatar));

            $user->update(['avatar' => $info['path']], ['id' => $id]);

            $user->close();

            header('Location: /private');
        }
    }
}
?>
