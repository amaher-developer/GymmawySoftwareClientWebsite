<?php

use Illuminate\Support\Facades\File;

foreach (File::allFiles(__DIR__ . '/Api') as $route) {
    require_once $route->getPathname();
}
