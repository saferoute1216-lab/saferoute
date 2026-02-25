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
if (method_exists('FamilyModel', 'hasPendingJoinRequest') 
    && FamilyModel::hasPendingJoinRequest($user_id)) {

    echo json_encode([
        "status" => "error",
        "message" => "You already have a pending join request."
    ]);
    exit;
}

/* =========================================
   Get Search Keyword
========================================= */
$keyword = trim($_GET['keyword'] ?? '');

/* =========================================
   Fetch Families
========================================= */
if (!empty($keyword)) {
    $families = FamilyModel::searchFamilies($keyword);
} else {
    $families = FamilyModel::getAllFamilies();
}

/* =========================================
   Return Success Response
========================================= */
echo json_encode([
    "status" => "success",
    "data"   => $families
]);
exit;
