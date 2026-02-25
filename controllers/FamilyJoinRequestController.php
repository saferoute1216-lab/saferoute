<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/FamilyModel.php';

session_start();

header('Content-Type: application/json');

/* =========================================
   Must Be Logged In
========================================= */
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode([
        "status" => "error",
        "message" => "Unauthorized"
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

/* =========================================
   Prevent If Already In Family
========================================= */
if (FamilyModel::userHasFamily($user_id)) {
    echo json_encode([
        "status" => "error",
        "message" => "You are already part of a family."
    ]);
    exit;
}

/* =========================================
   Prevent If Already Has Pending Request
========================================= */
if (FamilyModel::hasPendingJoinRequest($user_id)) {
    echo json_encode([
        "status" => "error",
        "message" => "You already have a pending join request."
    ]);
    exit;
}

/* =========================================
   Validate POST
========================================= */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method."
    ]);
    exit;
}

$family_id    = $_POST['family_id'] ?? '';
$full_name    = trim($_POST['full_name'] ?? '');
$relationship = trim($_POST['relationship'] ?? '');
$contact      = trim($_POST['contact'] ?? '');
$address      = trim($_POST['address'] ?? '');

if (empty($family_id) || empty($full_name) || empty($relationship)) {
    echo json_encode([
        "status" => "error",
        "message" => "Required fields are missing."
    ]);
    exit;
}

/* =========================================
   Handle Proof File Upload
========================================= */
$proof_file_path = null;

if (isset($_FILES['proof_file']) && $_FILES['proof_file']['error'] === 0) {

    $upload_dir = __DIR__ . '/../uploads/join_proofs/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = time() . '_' . basename($_FILES['proof_file']['name']);
    $target_path = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['proof_file']['tmp_name'], $target_path)) {
        $proof_file_path = 'uploads/join_proofs/' . $file_name;
    }
}

/* =========================================
   Create Join Request
========================================= */
$data = [
    'requested_by' => $user_id,
    'family_id'    => $family_id,
    'full_name'    => $full_name,
    'relationship' => $relationship,
    'contact'      => $contact,
    'address'      => $address,
    'proof_file'   => $proof_file_path
];

$created = FamilyModel::createJoinRequest($data);

if ($created) {
    echo json_encode([
        "status" => "success",
        "message" => "Join request submitted successfully. Waiting for admin approval."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to submit join request."
    ]);
}

exit;
