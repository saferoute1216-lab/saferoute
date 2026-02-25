<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/FamilyModel.php';

session_start();

/* =========================================
   Security: Must Be Logged In
========================================= */
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode([
        "error" => "Unauthorized"
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

/* =========================================
   Prevent If Already Has Family
========================================= */
if (FamilyModel::userHasFamily($user_id)) {
    http_response_code(400);
    echo json_encode([
        "error" => "You are already part of a family."
    ]);
    exit;
}

/* =========================================
   Get Search Keyword
========================================= */
$keyword = $_GET['keyword'] ?? '';
$keyword = trim($keyword);

/* =========================================
   Fetch Families
========================================= */
if (!empty($keyword)) {
    $families = FamilyModel::searchFamilies($keyword);
} else {
    $families = FamilyModel::getAllFamilies();
}

/* =========================================
   Return JSON
========================================= */
header('Content-Type: application/json');
echo json_encode($families);
exit;
