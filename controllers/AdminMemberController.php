<?php
require_once __DIR__ . '/../models/AdminMemberModel.php';

if (!isset($_GET['action'], $_GET['id'])) {
    header("Location: ../views/admin_family.php");
    exit;
}

$action = $_GET['action'];
$id = $_GET['id'];

if ($action === 'approve') {
    AdminMemberModel::approve($id);
}
elseif ($action === 'reject') {
    AdminMemberModel::reject($id);
}

header("Location: ../views/admin_family.php");
exit;
