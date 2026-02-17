<?php
session_start();

require_once __DIR__ . '/../models/FamilyModel.php';

/* logout handler */
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
}

/* must be logged in */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* ask model */
$family_id = FamilyModel::userHasFamily($user_id);

$family_members = [];
if ($family_id) {
    $family_members = FamilyModel::getFamilyMembers($family_id);
}

/* pass data to view */
require __DIR__ . '/../views/profile.php';
