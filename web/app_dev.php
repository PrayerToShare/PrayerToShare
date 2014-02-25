<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it, or make something more sophisticated.
if (!in_array($_SERVER['HTTP_HOST'], array('beta.prayer-to-share.com')) && !in_array(@$_SERVER['REMOTE_ADDR'], array(
    '127.0.0.1',
    '::1',
))) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require_once __DIR__.'/../app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
