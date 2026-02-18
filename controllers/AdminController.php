<?php
require_once __DIR__ . '/../models/AdminModel.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    die("Not authorized");
}

$action = $_GET['action'] ?? '';

/* =========================
   UPDATE ADMIN PROFILE
========================= */
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'first_name' => trim($_POST['first_name']),
        'last_name'  => trim($_POST['last_name']),
        'email'      => trim($_POST['email'])
    ];

    AdminModel::update($_SESSION['admin_id'], $data);

    /* update session display name if you store it */
    $_SESSION['admin_name'] =
        $data['first_name'] . ' ' . $data['last_name'];

    header("Location: /views/adminprofile.php?updated=1");
    exit;
}


/* =========================
   DELETE ADMIN ACCOUNT
========================= */
if ($action === 'delete') {

    AdminModel::delete($_SESSION['admin_id']);

    /* destroy session after delete */
    session_unset();
    session_destroy();

    header("Location: /views/signin_admin.php?deleted=1");
    exit;
}

die("Invalid action");
