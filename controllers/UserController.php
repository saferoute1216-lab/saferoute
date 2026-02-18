<?php
require_once __DIR__ . '/../models/UserModel.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /views/login.php");
    exit;
}

$userModel = new UserModel();
$user_id = $_SESSION['user_id'];

$action = $_GET['action'] ?? $_POST['action'] ?? null;

switch ($action) {

    /* =========================
       UPDATE ACCOUNT
    ==========================*/
    case 'update':

        $data = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name'  => trim($_POST['last_name'] ?? ''),
            'email'      => trim($_POST['email'] ?? ''),
            'address'    => trim($_POST['address'] ?? ''),
        ];

        if ($userModel->updateUser($user_id, $data)) {

            // update session display name if you store it
            $_SESSION['user_name'] =
                $data['first_name'] . ' ' . $data['last_name'];

            header("Location: /views/profile.php?updated=1");
            exit;
        }

        header("Location: /views/profile.php?error=update");
        exit;


    /* =========================
       DELETE ACCOUNT
    ==========================*/
    case 'delete':

        if ($userModel->deleteUser($user_id)) {

            session_destroy();
            header("Location: /views/login.php?deleted=1");
            exit;
        }

        header("Location: /views/profile.php?error=delete");
        exit;


    default:
        header("Location: /views/profile.php");
        exit;
}
