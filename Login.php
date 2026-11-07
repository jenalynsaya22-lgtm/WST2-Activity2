<?php
declare(strict_types=1);
require __DIR__ . '/includes/init.php';

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    // TODO 1: Fetch user
    $stmt = $conn->prepare(
        'SELECT id, username, password_hash, role FROM users WHERE username = ? LIMIT 1'
    );

    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // TODO 2: Verify password
    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header('Location: dashboard.php');
        exit;
    }

    // TODO 3: Generic error
    $error = 'Invalid username or password.';
}

$pageTitle = 'Log in';
require __DIR__ . '/includes/header.php';
?>

<section class="card narrow">
    <h1>Log in</h1>

    <?php if ($error): ?>
        <div class="errors"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="login.php">
        <label>Username
            <input type="text" name="username"
                value="<?= e($username) ?>" required autocomplete="username">
        </label>

        <label>Password
            <input type="password" name="password"
                required autocomplete="current-password">
        </label>

        <button type="submit">Log in</button>
    </form>

    <p class="muted">No account yet?
        <a href="register.php">Register</a>
    </p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>