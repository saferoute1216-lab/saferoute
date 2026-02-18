<?php
session_start();

require_once __DIR__ . '/../models/AccountModel.php';
require_once __DIR__ . '/../models/FamilyModel.php';

/* ===== Require login ===== */
$user_id = $_SESSION['user_id'] ?? 0;

if (!$user_id) {
    header("Location: /views/login.php");
    exit;
}

/* ===== Get user data ===== */
$user = AccountModel::getAccountById($user_id);

/* ===== Get family data ===== */
$family_id = FamilyModel::getUserFamilyId($user_id);
$family_members = $family_id
    ? FamilyModel::getFamilyMembers($family_id)
    : [];

/* ===== Load view ===== */
require __DIR__ . '/../views/profile.php';
