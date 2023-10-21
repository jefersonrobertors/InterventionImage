<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\User;
use app\services\CsfrService;
use core\UploadImage;

final class UploadController extends Controller {

    public function main() : void {
        if(!isset($_FILES['image'])) {
            header('Location: /?error=No image selected');
            exit;
        }
        if(CsfrService::isValidToken()) {
            CsfrService::destroyToken();

            $image = new UploadImage;
            $image->make()->resize(200, 300, true)->fit(200)->save();

            $info = $image->info();

            var_dump($info);

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