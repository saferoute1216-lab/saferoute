<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/FamilyModel.php';

session_start();

$user_id = $_SESSION['user_id'] ?? 0;

/* ===== Fetch user info from DB ===== */
$user_stmt = $pdo->prepare("
    SELECT first_name, last_name, email, address
    FROM userinfo
    WHERE id = ?
");
$user_stmt->execute([$user_id]);
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);

/* ===== Family lookup ===== */
$family_id = FamilyModel::getUserFamilyId($user_id);

$family_members = $family_id
    ? FamilyModel::getFamilyMembers($family_id)
    : [];

$family_id = $family_id ?? null;
$family_members = $family_members ?? [];
?>

<?php include 'header.php'; ?>

<head>
<meta charset="UTF-8">
<title>User Profile</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="profile.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<div class="profile-container">

<?php if (isset($_GET['submitted'])): ?>
<div class="success-msg">
Request submitted. Waiting for admin approval.
</div>
<?php endif; ?>

<?php if (isset($_GET['already_in_family'])): ?>
<div class="error-msg">
You are already part of a family.
</div>
<?php endif; ?>

<div class="profile-grid">

<!-- ================= MAIN PROFILE ================= -->
<div class="card main-profile">
<div class="profile-row">

<div class="avatar"></div>

<div class="info">
<p><strong>Complete Name:</strong><br>
<?= htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?>
</p>

<p><strong>Email Address:</strong><br>
<?= htmlspecialchars($user['email'] ?? '') ?>
</p>

<p><strong>Address:</strong><br>
<?= htmlspecialchars($user['address'] ?? '') ?>
</p>
</div>

<div class="status">
Status: <span class="safe">Safe</span>
</div>

</div>
</div>

<!-- ================= SIDE CARD ================= -->
<div class="card side-card">

<h3>Family Information</h3>

<?php if (!$family_id): ?>
<p>No family assigned yet.</p>
<?php else: ?>
<p>Family ID: <?= $family_id ?></p>

<?php if (!empty($family_members)): ?>
<ul>
<?php foreach ($family_members as $m): ?>
<li><?= htmlspecialchars($m['full_name']) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

<?php endif; ?>

<hr>

<?php if (!$family_id): ?>

<button class="add-family-btn" onclick="openChoiceModal()">
<i class="fa fa-users"></i> Family Setup
</button>

<?php else: ?>

<button class="add-family-btn" onclick="openAddMemberModal()">
<i class="fa fa-user-plus"></i> Add Family Member
</button>

<?php endif; ?>

<hr>

<h3>Notification Methods</h3>
<div class="notif-option checked">SMS</div>
<div class="notif-option checked">Email</div>
<div class="notif-option">Push Notification</div>

</div>

<!-- ================= EVAC CARD ================= -->
<div class="card evac-card">
<h3>Evacuation Preferences:</h3>

<div class="center preferred">
La Carlota South Elementary School 1
</div>

<div class="center alternative">
La Carlota North Elementary School 2
</div>

</div>

</div>

<div class="actions">
<button class="edit">Edit</button>
<a href="/controllers/ProfileController.php?action=logout" class="logout">
Logout
</a>
</div>

</div>

<!-- ================= CHOICE MODAL ================= -->
<?php if (!$family_id): ?>
<div id="choiceModal" class="modal">
<div class="modal-content">
<span class="close" onclick="closeChoiceModal()">&times;</span>

<h2>Family Setup</h2>

<button class="modal-btn" onclick="openJoinModal()">
Join Existing Family
</button>

<button class="modal-btn" onclick="openRegisterModal()">
Register New Family
</button>

</div>
</div>
<?php endif; ?>

<!-- ================= JOIN MODAL ================= -->
<?php if (!$family_id): ?>
<div id="joinModal" class="modal">
<div class="modal-content">
<span class="close" onclick="closeJoinModal()">&times;</span>

<h2>Join Family</h2>

<form method="POST" action="/controllers/FamilyRequestController.php">
<input type="hidden" name="request_type" value="join">

<label>Family Code / Name</label>
<input type="text" name="family_lookup" required>

<label>Relationship</label>
<select name="relationship" required>
<option>Father</option>
<option>Mother</option>
<option>Child</option>
<option>Relative</option>
</select>

<label>Contact Number</label>
<input type="text" name="family_contact" required>

<label>Address</label>
<textarea name="family_address" required></textarea>

<button type="submit" class="modal-btn">
Submit Join Request
</button>
</form>

</div>
</div>
<?php endif; ?>

<!-- ================= REGISTER MODAL ================= -->
<?php if (!$family_id): ?>
<div id="registerModal" class="modal">
<div class="modal-content">
<span class="close" onclick="closeRegisterModal()">&times;</span>

<h2>Register New Family</h2>

<form method="POST"
      action="/controllers/FamilyRequestController.php"
      enctype="multipart/form-data">

<input type="hidden" name="mode" value="register">

<label>Family Name</label>
<input type="text" name="family_name" required>

<label>Address</label>
<textarea name="address" required></textarea>

<label>Barangay</label>
<input type="text" name="barangay" required>

<label>Proof of Residency</label>
<input type="file" name="proof_file">

<button type="submit">
Submit New Family Request
</button>

</form>
</div>
</div>
<?php endif; ?>

<!-- ================= ADD MEMBER MODAL ================= -->
<?php if ($family_id): ?>
<div id="addMemberModal" class="modal">
<div class="modal-content">
<span class="close" onclick="closeAddMemberModal()">&times;</span>

<h2>Add Family Member</h2>

<form method="POST" action="/controllers/AddMemberController.php">

<input type="hidden" name="family_id" value="<?= $family_id ?>">

<label>Full Name</label>
<input type="text" name="full_name" required>

<label>Age</label>
<input type="number" name="age" required>

<label>Sex</label>
<select name="sex">
<option>Male</option>
<option>Female</option>
</select>

<button type="submit">
Add Member
</button>

</form>
</div>
</div>
<?php endif; ?>

<script src="/js/profile.js"></script>

<?php include 'footer.php'; ?>
