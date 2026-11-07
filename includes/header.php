<?php
declare(strict_types=1);
// includes/header.php – ACTIVITY 2

$loggedIn = !empty($_SESSION['user_id']);
$role = $_SESSION['role'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/style.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? 'WST2 Secure App') ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/style.css">
</head>
<body>
<header class="topbar">
    <a class="brand" href="<?= BASE_URL ?>/dashboard.php">WST2 Secure App</a>

    <?php if ($loggedIn): ?>
        <nav>
            <a href="<?= BASE_URL ?>/dashboard.php">Dashboard</a>

            <?php if ($role === 'admin'): ?>
                <a href="<?= BASE_URL ?>/admin/manage_users.php">Manage Users</a>
            <?php endif; ?>

            <?php if (in_array($role, ['admin', 'instructor'], true)): ?>
                <a href="<?= BASE_URL ?>/instructor/encode_grades.php">Encode Grades</a>
            <?php endif; ?>

            <?php if ($role === 'student'): ?>
                <a href="<?= BASE_URL ?>/student/my_grades.php">My Grades</a>
            <?php endif; ?>

            <span class="who">
                <?= e($_SESSION['username'] ?? '') ?> (<?= e($role) ?>)
            </span>

            <a class="btn-small" href="<?= BASE_URL ?>/logout.php">Log out</a>
        </nav>
    <?php endif; ?>
</header>

<main class="container">
<?php if ($msg = flash()): ?>
    <div class="alert"><?= e($msg) ?></div>
<?php endif; ?>
```