<?php

declare(strict_types=1);

namespace app\controllers;

abstract class Controller {

    public function view(string $viewName) : void {
        require_once __DIR__ . "/../views/{$viewName}.php";
    }
}
?>