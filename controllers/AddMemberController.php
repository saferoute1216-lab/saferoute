<?php
require_once __DIR__ . '/../config/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $requested_by = $_SESSION['user_id'] ?? 0;
    $family_id    = $_POST['family_id'] ?? null;
    $full_name    = trim($_POST['full_name'] ?? '');
    $relationship = $_POST['relationship'] ?? '';
    $contact      = $_POST['contact'] ?? '';
    $address      = $_POST['address'] ?? '';

    if (!$requested_by || !$family_id || !$full_name || !$relationship || !$contact || !$address) {
        header("Location: /views/profile.php?error=missing_fields");
        exit;
    }

    /* ===== File Upload ===== */
    $proof_path = null;

    if (!empty($_FILES['proof_file']['name'])) {

        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $filename = time() . '_' . basename($_FILES['proof_file']['name']);
        $target = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['proof_file']['tmp_name'], $target)) {
            $proof_path = 'uploads/' . $filename;
        }
    }

    /* ===== Insert into family_member_requests ===== */
    $stmt = $pdo->prepare("
        INSERT INTO family_member_requests
        (requested_by, family_id, full_name, relationship, contact, address, proof_file, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')
    ");

    $stmt->execute([
        $requested_by,
        $family_id,
        $full_name,
        $relationship,
        $contact,
        $address,
        $proof_path
    ]);

    header("Location: /views/profile.php?submitted=1");
    exit;
}
