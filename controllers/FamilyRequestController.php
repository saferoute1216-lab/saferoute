<?php
session_start();

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/FamilyModel.php';

/* must be logged in */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

/* block if already in a family */
if (FamilyModel::userHasFamily($_SESSION['user_id'])) {
    header("Location: ../controllers/ProfileController.php?already_in_family=1");
    exit;
}

/* only accept POST */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../controllers/ProfileController.php");
    exit;
}

$proofName = null;

/* ================= FILE UPLOAD (optional) ================= */

if (!empty($_FILES['proof_file']['name'])) {

    $uploadDir = __DIR__ . '/../uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['proof_file']['name']);
    $proofName = time() . "_" . $safeName;

    move_uploaded_file(
        $_FILES['proof_file']['tmp_name'],
        $uploadDir . $proofName
    );
}

/* ================= FORM MODE ================= */

$familyName =
    $_POST['family_name']
    ?? $_POST['family_lookup']
    ?? null;

$address  = $_POST['address']  ?? null;
$barangay = $_POST['barangay'] ?? null;

/* ================= INSERT REQUEST ================= */

$sql = "
INSERT INTO family_requests
(requested_by, family_name, address, barangay, proof_file, status)
VALUES (:requested_by, :family_name, :address, :barangay, :proof_file, 'pending')
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':requested_by' => $_SESSION['user_id'],
    ':family_name'  => $familyName,
    ':address'      => $address,
    ':barangay'     => $barangay,
    ':proof_file'   => $proofName
]);

/* ================= REDIRECT BACK ================= */

header("Location: ../controllers/ProfileController.php?submitted=1");
exit;
