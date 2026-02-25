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
$relationship = trim($_POST['relationship'] ?? '');

if (empty($family_id) || empty($relationship)) {
    echo json_encode([
        "status" => "error",
        "message" => "Please select a family and relationship."
    ]);
    exit;
}

/* =========================================
   Create Join Request
========================================= */
$created = FamilyModel::createJoinRequest(
    $user_id,
    $family_id,
    $relationship
);

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
