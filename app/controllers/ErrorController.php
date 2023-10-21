<?php

declare(strict_types=1);

namespace app\controllers;

final class ErrorController extends Controller {

    public function notFound() : void {
        $this->view('404');
    }
}
?>