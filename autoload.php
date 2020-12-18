<?php

declare(strict_types=1);

spl_autoload_register(
    static function (string $class): void { 
        require_once(strtolower($class . '.php'));
    }
);
