<?php
declare(strict_types=1);
require __DIR__ . '/includes/init.php';

// TODO 1: Clear session variables
session_unset();
$_SESSION = [];

// TODO 2: Delete session cookie
$p = session_get_cookie_params();

setcookie(
    session_name(),
    '',
    time() - 42000,
    $p['path'],
    $p['domain'],
    $p['secure'],
    $p['httponly']
);

// TODO 3: Destroy session
session_destroy();

// TODO 4: Redirect to login
header('Location: login.php');
exit;