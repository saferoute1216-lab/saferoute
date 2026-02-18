<?php
session_start();

require_once __DIR__ . '/../models/FamilyModel.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

/* logout */
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* ALWAYS define defaults */
$family_id = null;
$family_members = [];

/* ask model */
$family_id = FamilyModel::getUserFamilyId($user_id);

if ($family_id) {
    $family_members = FamilyModel::getFamilyMembers($family_id);
}

header("Location: ../views/profile.php");
exit;
