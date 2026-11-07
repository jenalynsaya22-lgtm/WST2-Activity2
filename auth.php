<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/init.php';

function require_login(): void
{
    if (empty($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '/login.php');
        exit;
    }
}

function require_role(string ...$roles): void
{
    require_login();

    if (!in_array($_SESSION['role'] ?? '', $roles, true)) {
        http_response_code(403);
        require __DIR__ . '/403.php';
        exit;
    }
}