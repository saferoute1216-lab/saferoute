<?php
require_once __DIR__ . '/../config/db.php';

session_start();

$user_id = $_SESSION['user_id'] ?? 0;

/* ===== Fetch admin info ===== */
$user_stmt = $pdo->prepare("
    SELECT first_name, last_name, email, address
    FROM userinfo
    WHERE id = ?
");
$user_stmt->execute([$user_id]);
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Admin not found.");
}
?>

<?php include 'header.php'; ?>

<head>
<meta charset="UTF-8">
<title>Admin Profile</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="profile.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<div class="profile-container">

<?php if (isset($_GET['updated'])): ?>
<div class="success-msg">
Profile updated successfully.
</div>
<?php endif; ?>

<div class="profile-grid">

<!-- ================= MAIN PROFILE ================= -->
<div class="card main-profile">
<div class="profile-row">

<div class="avatar admin-avatar"></div>

<div class="info">
<p><strong>Admin Name:</strong><br>
<?= htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?>
</p>

<p><strong>Email Address:</strong><br>
<?= htmlspecialchars($user['email'] ?? '') ?>
</p>

<p><strong>Address:</strong><br>
<?= htmlspecialchars($user['address'] ?? '') ?>
</p>

<p><strong>Role:</strong><br>
Administrator
</p>
</div>

<div class="status">
Status: <span class="safe">Active</span>
</div>

</div>
</div>

<!-- ================= SIDE CARD ================= -->
<div class="card side-card">

<h3>Admin Controls</h3>

<div class="notif-option checked">System Access</div>
<div class="notif-option checked">User Management</div>
<div class="notif-option checked">Request Approval</div>

<hr>

<h3>Quick Actions</h3>

<a href="/admin/dashboard.php" class="add-family-btn">
<i class="fa fa-chart-line"></i> Dashboard
</a>

<a href="/admin/users.php" class="add-family-btn">
<i class="fa fa-users"></i> Manage Users
</a>

</div>

<!-- ================= SYSTEM CARD ================= -->
<div class="card evac-card">
<h3>System Panel</h3>

<div class="center preferred">
Full Administrative Access
</div>

<div class="center alternative">
Profile & Account Controls Enabled
</div>

</div>

</div>

<!-- ================= ACTION BUTTONS ================= -->
<div class="actions">

<button class="edit" onclick="openEditModal()">
Edit Account
</button>

<a href="/controllers/UserController.php?action=delete"
   class="delete"
   onclick="return confirm('Delete this admin account permanently?')">
Delete Account
</a>

<a href="/controllers/ProfileController.php?action=logout" class="logout">
Logout
</a>

</div>

</div>

<!-- ================= EDIT ACCOUNT MODAL ================= -->
<div id="editModal" class="modal">
<div class="modal-content">
<span class="close" onclick="closeEditModal()">&times;</span>

<h2>Edit Admin Account</h2>

<form method="POST" action="/controllers/UserController.php?action=update">

<label>First Name</label>
<input type="text"
       name="first_name"
       value="<?= htmlspecialchars($user['first_name']) ?>"
       required>

<label>Last Name</label>
<input type="text"
       name="last_name"
       value="<?= htmlspecialchars($user['last_name']) ?>"
       required>

<label>Email</label>
<input type="email"
       name="email"
       value="<?= htmlspecialchars($user['email']) ?>"
       required>

<label>Address</label>
<textarea name="address"
          required><?= htmlspecialchars($user['address']) ?></textarea>

<button type="submit" class="modal-btn">
Save Changes
</button>

</form>
</div>
</div>

<script src="/js/profile.js"></script>

<?php include 'footer.php'; ?>
