<?php
declare(strict_types=1);

// admin/manage_users.php – ACTIVITY 2
// Access matrix: Admin ✓ Instructor ✗ Student ✗

require __DIR__ . '/../auth.php';

// Only administrators can access this page.
require_role('admin');

// Get all users from the database.
$users = $conn->query(
    'SELECT id, username, email, role, created_at FROM users ORDER BY id'
)->fetch_all(MYSQLI_ASSOC);

$pageTitle = 'Manage Users';
require __DIR__ . '/../includes/header.php';
?>

<section class="card">
    <h1>Manage Users <span class="badge">admin only</span></h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= (int) $u['id'] ?></td>
                <td><?= e($u['username']) ?></td>
                <td><?= e($u['email']) ?></td>
                <td><?= e($u['role']) ?></td>
                <td><?= e($u['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <p class="muted">
        Tip: change roles for your test accounts in phpMyAdmin.
    </p>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
```