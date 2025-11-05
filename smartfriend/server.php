<?php

if (PHP_SAPI === 'cli-server') {
    $_SERVER['PHP_SELF'] = '/index.php';
}

require __DIR__.'/public/index.php';
